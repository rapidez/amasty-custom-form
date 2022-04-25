<div v-if="['radio', 'radiotwo'].includes(input.type)">
    <x-rapidez::label v-for="checkbox in input.values">
        <input
            type="radio"
            v-bind:name="input.name"
            v-model="variables.form_data[input.name]"
            v-bind:value="checkbox.value"
            v-bind:style="input.style"
        > @{{ checkbox.label }}
    </x-rapidez::label>
</div>
