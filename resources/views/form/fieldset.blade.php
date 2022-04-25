<fieldset v-for="(form, index) in data.form_json" class="grid grid-cols-12 gap-2 my-2">
    <legend v-if="data.form_title[index]" class="font-bold text-lg mb-2">@{{ data.form_title[index] }}</legend>
    <template v-for="input in form">
        @include('amasty-custom-form::form.form-elements')
    </template>
</fieldset>
