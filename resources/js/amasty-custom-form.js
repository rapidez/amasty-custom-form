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
    let replaceVariables = value => value
        // Customer Variables
        .replaceAll('{firstname}', window.app?.user?.firstname ?? '')
        .replaceAll('{lastname}', window.app?.user?.lastname ?? '')
        .replaceAll('{email}', window.app?.user?.email ?? '')
        .replaceAll('{company}', window.app?.user?.addresses[0]?.company ?? '')
        .replaceAll('{telephone}', window.app?.user?.addresses[0]?.telephone ?? '')
        .replaceAll('{street}', window.app?.user?.addresses[0]?.street?.join(' ') ?? '')
        .replaceAll('{city}', window.app?.user?.addresses[0]?.city ?? '')
        .replaceAll('{region}', window.app?.user?.addresses[0]?.region?.region ?? '')
        .replaceAll('{postcode}', window.app?.user?.addresses[0]?.postcode ?? '')
        // General Variables
        .replaceAll('{url}', window.location.href)
        .replaceAll('{product_url}', window.location.href);

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
