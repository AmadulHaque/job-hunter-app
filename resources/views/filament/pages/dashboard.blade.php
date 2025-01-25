<x-filament::page>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <x-custom-card
            title="Total JobApplication"
            value="{{ $this->jobApplication::count() }}"
            description=""
            color="blue"
        />
    </div>
</x-filament::page>
