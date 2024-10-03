<x-filament::widget>
    <x-filament::card>
        <form wire:submit.prevent="sendMessage">
            {{ $this->form }}

            <x-filament::button type="submit" class="mt-3">
                Send Message
            </x-filament::button>
        </form>
    </x-filament::card>
</x-filament::widget>