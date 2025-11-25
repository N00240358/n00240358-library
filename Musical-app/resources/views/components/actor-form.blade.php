@props(['action', 'method', 'actor' => null, 'musicals' => [], 'actorMusical' => []])<!-- gets action, method, and actor as properties to call from the database -->

<form action="{{ $action }}" method="POST" enctype="multipart/form-data"> {{-- form to create or edit a actor --}}
    @csrf
    @if($method === 'PUT' || $method === 'PATCH') 
        @method($method) 
    @endif

    {{-- Name --}}
    <div class="mb-4">
        <label for="name" class="block text-sm text-white">Name</label>
        <input 
            type="text" 
            name="name" 
            id="name"
            value="{{ old('name', $actor->name ?? '') }}"  {{-- if there is an old value from a failed validation will use it, otherwise get the name from the id if editing --}}
            required
            class="mt-1 block w-2/3 border-gray-300 rounded-md shadow-sm bg-[#2b1b1b] text-white" />
        @error('name')
            <p class="text-sm text-red-600">{{ $message }}</p> <!-- displays error message if validation fails -->
        @enderror
    </div>

    {{-- Biography --}}
    <div class="mb-4">
        <label for="biography" class="block text-sm text-white">Biography</label>
        <textarea 
            name="biography"
            id="biography"
            rows="6"
            class="mt-1 block w-5/6 h-40 border-gray-300 rounded-md shadow-sm resize-y bg-[#2b1b1b] text-white">{{ old('biography', $actor->biography ?? '') }}</textarea> {{-- if there is an old value from a failed validation will use it, otherwise get the biography from the id if editing --}}
        @error('biography')
            <p class="text-sm text-red-600">{{ $message }}</p> <!-- displays error message if validation fails -->
        @enderror
    </div>

    {{-- Date of Birth --}}
    <div class="mb-4">
        <label for="birthdate" class="block text-sm text-white">Date of Birth</label>
        <input 
            type="text"
            name="birthdate"
            id="birthdate"
            value="{{ old('birthdate', $actor->birthdate ?? '') }}" {{-- if there is an old value from a failed validation will use it, otherwise get the Date of Birth from the id if editing --}}
            required
            class="mt-1 block w-52 border-gray-300 rounded-md shadow-sm bg-[#2b1b1b] text-white" />
        @error('birthdate')
            <p class="text-sm text-red-600">{{ $message }}</p> <!-- displays error message if validation fails -->
        @enderror
    </div>

    <div class="mb-4">
        <label for="musicals" class="block text-sm text-white mb-2">Musicals</label>

        <select id="musicals" name="musicals[]" multiple class="w-2/3 bg-[#2b1b1b] text-white">
            @foreach($musicals as $musical)
                <option 
                    value="{{ $musical->id }}"
                    @if(isset($actorMusical) && in_array($musical->id, $actorMusical)) selected @endif
                >
                    {{ $musical->title }}
                </option>
            @endforeach
        </select>

        @error('musicals')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex space-x-4 mt-4">
        <x-primary-button>
            {{ isset($actor) ? 'Update Actor' : 'Add Actor' }} <!-- changes button text depending on if creating or editing -->
        </x-primary-button> 

        <a href="{{ route('actors.index') }}" {{-- A button that is using the same styling as the primary button to go back to the index without making any changes. --}}
           class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-gray-600 text-[#f2c94c] font-bold rounded-md shadow-md transition">
            Cancel
        </a>
    </div>
</form>


{{-- All the code and styling for the TomSelect to Work. --}}
@push('scripts')
<style>
    /* preview area below the TomSelect field */
    #selected-musicals-container {
        margin-top: 1rem;
        max-height: 5rem;      /* ~5rem visible */
        overflow: hidden;
        transition: max-height 0.28s ease;
    }
    #selected-musicals-container.expanded {
        max-height: none;
    }

    .selected-musical-item {
        display: inline-block;
        background: #444;
        color: white;
        padding: 0.35rem 0.65rem;
        margin: 0.25rem;
        border-radius: 0.4rem;
        font-size: 0.85rem;
        cursor: pointer; /* clickable to remove */
    }

    .selected-musical-item:hover {
        opacity: 0.9;
    }

    #toggle-musicals {
        cursor: pointer;
        color: #f2c94c;
        font-weight: 700;
        margin-top: .5rem;
        display: none; /* shown only when needed */
    }

    /* hide TomSelect's tag visuals inside the control */
    .ts-control .item { display: none !important; }
    .ts-control input[type="text"] { opacity: 1 !important; }
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    try {
        if (typeof TomSelect === 'undefined') {
            console.error('TomSelect is not loaded. Make sure the TomSelect script is included before this script.');
            return;
        }

        const selectElem = document.querySelector("#musicals");
        if (!selectElem) {
            console.error('#musicals select element not found in DOM.');
            return;
        }

        // Initialize TomSelect
        const select = new TomSelect("#musicals", {
            plugins: ['remove_button'],
            maxItems: null,
            placeholder: "Search & select musicals...",
            hideSelected: true,
            // keep updates in sync via handlers below
            onItemAdd: () => updateSelectedMusicals(),
            onItemRemove: () => updateSelectedMusicals(),
        });

        // Preview container + toggle
        const container = document.createElement("div");
        container.id = "selected-musicals-container";
        const toggleBtn = document.createElement("div");
        toggleBtn.id = "toggle-musicals";
        toggleBtn.textContent = "See more";
        const selectParent = selectElem.parentNode;
        selectParent.appendChild(container);
        selectParent.appendChild(toggleBtn);

        // Expand/collapse toggle
        toggleBtn.addEventListener("click", function() {
            container.classList.toggle("expanded");
            toggleBtn.textContent = container.classList.contains("expanded") ? "See less" : "See more";
        });

        // Build preview from TomSelect's internal items (instant & reliable)
        function updateSelectedMusicals() {
            container.innerHTML = "";

            // Use TomSelect's selected values (string array)
            const selectedValues = Array.isArray(select.items) ? select.items.slice() : [];

            selectedValues.forEach(value => {
                // find the option text in the native select (fallback safe search)
                const opt = Array.from(selectElem.options).find(o => String(o.value) === String(value));
                const text = opt ? opt.text : value;

                const tag = document.createElement("span");
                tag.classList.add("selected-musical-item");
                tag.textContent = text;
                tag.setAttribute('data-value', value);

                // click to remove this musical (immediately updates TomSelect & preview)
                tag.addEventListener('click', function(e) {
                    e.preventDefault();
                    const val = this.getAttribute('data-value');
                    // remove from TomSelect; this will trigger onItemRemove -> updateSelectedMusicals
                    if (select && typeof select.removeItem === 'function') {
                        select.removeItem(val);
                    } else {
                        // fallback: deselect native option and dispatch change
                        const nativeOpt = Array.from(selectElem.options).find(o => String(o.value) === String(val));
                        if (nativeOpt) {
                            nativeOpt.selected = false;
                            selectElem.dispatchEvent(new Event('change', { bubbles: true }));
                            updateSelectedMusicals();
                        }
                    }
                });

                container.appendChild(tag);
            });

            // show toggle only when content exceeds visible area
            setTimeout(() => {
                const computed = getComputedStyle(container);
                // parse max-height (if 'none' treat small)
                const maxH = computed.maxHeight === 'none' ? 9999 : parseFloat(computed.maxHeight) || 80;
                if (container.scrollHeight > maxH + 2) {
                    toggleBtn.style.display = "block";
                } else {
                    toggleBtn.style.display = "none";
                    // also ensure collapsed state when not needed
                    container.classList.remove("expanded");
                    toggleBtn.textContent = "See more";
                }
            }, 50);
        }

        // initial render (handles preselected items on edit page)
        updateSelectedMusicals();

        // Defensive MutationObserver: keep preview up-to-date if something else changes native <select>
        const observer = new MutationObserver(() => updateSelectedMusicals());
        observer.observe(selectElem, { attributes: true, subtree: true, attributeFilter: ['selected'] });
        window.addEventListener('beforeunload', () => observer.disconnect());

    } catch (err) {
        console.error('Error initializing TomSelect preview area:', err);
    }
});
</script>
@endpush