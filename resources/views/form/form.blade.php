<form slot-scope="{ mutate, variables, mutated, error }" v-on:submit.prevent="mutate">
    <h2 class="font-bold text-xl mb-5">@{{ data.title }}</h2>
    <input type="hidden" name="form_id" v-model="variables.form_data.form_id">
    @include('amasty-custom-form::form.fieldset')
    <button type="submit" class="inline-block font-semibold py-2 px-4 border rounded disabled:opacity-50 disabled:cursor-not-allowed hover:opacity-75 bg-primary border-primary text-white">@{{ data.submit_button }}</button>
</form>
