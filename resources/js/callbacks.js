import 'Vendor/rapidez/core/resources/js/vue'

Vue.prototype.transformAmCustomFormResponse = async function (response) {
    let data
    if(!(data = response.data.data.customform)) {
        return response.data.data
    }

    if (data.form_json) {
        data.form_json = JSON.parse(data.form_json)
    }

    if (data.form_title) {
        data.form_title = JSON.parse(data.form_title)
    }

    return data
}

Vue.prototype.amFormToVariables = function (form) {
    let variables = {form_data: {form_id: form.form_id}}

    let navigate = (pointer, part) => {
        if(!pointer) {
            return null
        }

        if(part.startsWith('custom:')) {
            return pointer.custom_attributes?.find(attribute => attribute.attribute_code === part.substring(7)).value
        }
        switch(part) {
            case 'address':
                return pointer.addresses?.[0]
            case 'billing':
            case 'shipping':
                let id = pointer['default_'+part]
                return pointer.addresses?.find(address => address.id == id)
            case 'street':
                return pointer.street?.join(' ')

            default:
                return pointer[part]
        }
    }

    let getUserVariable = (parts) => {
        let pointer = window.app?.user
        if(!pointer) {
            return ''
        }

        // Iterate through the parts to navigate the user object
        for(const part of parts) {
            let fallback = navigate(pointer?.addresses?.[0], part)
            pointer = navigate(pointer, part)

            // Return empty string when not defined
            if(!pointer) {
                if(fallback) {
                    return fallback
                }
                return ''
            }
        }
        return pointer
    }

    let getProductVariable = (name) => {
        let product = window.config.product

        if (name == 'final_price') {
            return product.special_price || product.price
        }

        return product[name] ?? '';
    }

    let replaceVariables = (value) => {
        // Get all {}-enclosed variables and replace them
        value = value.replaceAll(/(?<replace>{(?<variable>[^\}]*)})/g, (match, replace, input) => {
            switch(input) {
                case '{product_url}':
                case '{url}': return window.location.href

                default:
                    if (input.startsWith('product_')) {
                        return getProductVariable(input.substring(8))
                    }
                    return getUserVariable(input.split('.'))
            }
        })

        return value
    }

    form.form_json.map(form => {
        form.map(field => {
            if (['wysiwyg', 'hone', 'htwo', 'hthree', 'text'].includes(field.type)) {
                return;
            }
            let value;
            if (value = field.value) {
                variables.form_data[field.name] = replaceVariables(value)
            }

            if (value = field.values) {
                variables.form_data[field.name] = value.filter(multi => multi.selected).map(multi => multi.value)
            }
        })
    });

    return variables
}

Vue.prototype.amFormBeforeRequest = function (query, variables, options) {
    variables = JSON.parse(JSON.stringify(variables))
    variables.form_data = JSON.stringify(variables.form_data)

    return [query, variables, options];
}
