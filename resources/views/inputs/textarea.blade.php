<textarea
    v-if="input.type === 'textarea'"
    v-model="variables.form_data[input.name]"
    v-bind:id="input.name"
    v-bind:name="input.name"
    v-bind:required="input.required"
    v-bind:placeholder="input.placeholder"
    v-bind:rows="input.rows"
    v-bind:style="input.style"
    class="w-full py-2 px-3 border-gray-300 rounded focus:ring-green-500 focus:border-green-500 sm:text-sm"
></textarea>
