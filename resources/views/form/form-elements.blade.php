<div
class="inline-block col-span-12"
v-bind:class="{'sm:col-span-6': input.layout === 'two', 'sm:col-span-4': input.layout === 'three'}"
v-if="input.dependency.length === 0 || !input.dependency.filter(dependency => !variables.form_data[dependency.field].includes(dependency.value)).length"
>
    <x-rapidez::label v-bind:title="input.description" v-bind:for="input.name" v-if="input.label && !['text', 'hone', 'htwo', 'hthree'].includes(input.type)">
        @{{ input.label }} <span v-if="input.required">*</span>
    </x-rapidez::label>
    @include('amasty-custom-form::inputs.input')
    @include('amasty-custom-form::inputs.textarea')
    @include('amasty-custom-form::inputs.select')
    @include('amasty-custom-form::inputs.checkbox')
    @include('amasty-custom-form::inputs.radio')
    <div v-if="input.type === 'wysiwyg'" v-html="input.value" class="w-full"></div>
    <h1 v-if="input.type === 'hone'" class="text-2xl font-bold">@{{ input.label }}</h1>
    <h2 v-if="input.type === 'htwo'" class="text-xl font-bold">@{{ input.label }}</h2>
    <h3 v-if="input.type === 'hthree'" class="text-lg font-bold">@{{ input.label }}</h3>
    <p v-if="input.type === 'text'">@{{ input.label }}</p>
</div>
