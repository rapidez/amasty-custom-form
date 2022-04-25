<graphql v-cloak query="@include('amasty-custom-form::graphql.customform')" :variables="{ formId: {{ $formId }} }" :callback="transformAmCustomFormResponse">
    <div v-if="data" slot-scope="{ data }">
        <graphql-mutation
            query="mutation amCustomFormSubmit ($form_data: String!) { amCustomFormSubmit(input: {form_data: $form_data}) { status } }"
            :redirect="data.success_url"
            :notify="{message: data.success_message, type: 'success'}"
            :variables="amFormToVariables(data)"
            :before-request="amFormBeforeRequest"
        >
            @include('amasty-custom-form::form.form')
        </graphql-mutation>
    </div>
</graphql>
