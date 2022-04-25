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

    form.form_json.map(form => {
        form.map(field => {
            if (['wysiwyg', 'hone', 'htwo', 'hthree', 'text'].includes(field.type)) {
                return;
            }
            let value;
            if (value = field.value) {
                variables.form_data[field.name] = value
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
