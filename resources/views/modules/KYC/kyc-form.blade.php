<div>
    <style>
        input {
            border-color: #1a202c;
            border-width: 1px;
            color: #0a0e14 !important;
        }
        select option {
            color: #0a0e14 !important;
        }
    </style>
    <form wire:submit="create" enctype="multipart/form-data">
        @csrf
        {{ $this->form }}

        <button type="submit" class="bg-gray bg-primary bg-secondary btn">
            Submit
        </button>
    </form>

    <x-filament-actions::modals />
    @filamentStyles
    @filamentScripts
</div>

