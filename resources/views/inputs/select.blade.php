<select
    v-if="['dropdown', 'listbox'].includes(input.type)"
    v-model="variables.form_data[input.name]"
    v-bind:id="input.name"
    v-bind:multiple="input.type === 'listbox'"
    v-bind:name="input.name"
    v-bind:required="input.required"
    v-bind:placeholder="input.placeholder"
    v-bind:style="input.style"
    class="w-full py-2 pl-3 pr-8 border-gray-300 rounded focus:ring-green-500 focus:border-green-500 sm:text-sm"
>
    <option v-for="option in input.values" v-bind:value="option.value" v-bind:selected="option.selected">@{{ option.label }}</option>
</select>
