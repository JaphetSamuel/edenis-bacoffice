<div>
    <style>
        input {
            border-color: #1a202c;
            border-width: 1px;
        }
    </style>
    <form wire:submit="create" enctype="multipart/form-data">
        @csrf
        {{ $this->form }}

        <button type="submit">
            Submit
        </button>
    </form>

    <x-filament-actions::modals />
    @filamentStyles
    @filamentScripts
</div>

