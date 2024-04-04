@props(['id' => 'dropzone-file', 'label' => 'Click to upload', 'name'])

<div class="flex items-center justify-center w-full">
    <label for="{{ $id }}-area" id="{{ $id }}-area" {{ $attributes->merge(['class' => 'flex flex-col relative items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600']) }}>
        <div class="flex flex-col items-center justify-center pt-5 pb-6 mx-5" id="{{ $id }}-text" >
            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
            </svg>
            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">{{ $label }}</span> or drag and drop a photo</p>
            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, or JPEG</p>
        </div>
        <input id="{{ $id }}" name="{{ $name }}" type="file" accept="image/*" class="hidden" />

        <!-- Thumbnail preview container -->
        <div id="{{ $id }}-preview" class="max-w-full overflow-hidden max-h-64 relative">
        </div>
        <button type="button" id="{{ $id }}-remove" class="absolute hidden top-2 right-2 z-50 text-gray-500 rounded-full size-8 items-center justify-center text-[1.5rem] hover:bg-gray-100 hover:bg-opacity-30 active:bg-opacity-30 active:bg-gray-300">×</button>  
    </label>
</div>

@push('scripts')
    <script>
        (function () {
            const dropArea = document.getElementById("{{ $id }}-area");
            const fileElem = document.getElementById("{{ $id }}");
            const thumbnail = document.getElementById("{{ $id }}-preview");
            const dropText = document.getElementById("{{ $id }}-text");
            const removePreview = document.getElementById("{{ $id }}-remove");

            ["dragenter", "dragover", "dragleave", "drop"].forEach((eventName) => {
                dropArea.addEventListener(eventName, preventDefaults, false);
                document.body.addEventListener(eventName, preventDefaults, false);
            });

            ["dragenter", "dragover"].forEach((eventName) => {
                dropArea.addEventListener(eventName, highlight, false);
            });

            ["dragleave", "drop"].forEach((eventName) => {
                dropArea.addEventListener(eventName, unhighlight, false);
            });

            dropArea.addEventListener("drop", handleDrop, false);

            removePreview.addEventListener("click", () => {
                clearGallery();
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            function highlight(e) {
                dropArea.classList.add("highlight");
            }

            function unhighlight(e) {
                dropArea.classList.remove("highlight");
            }

            function handleDrop(e) {
                let dt = e.dataTransfer;
                let files = dt.files;
                handleFiles(files);
            }

            dropArea.addEventListener("click", () => {
                fileElem.click();
            });

            fileElem.addEventListener("change", function (e) {
                // displays or hides the clear thumbnail button
                removePreview.style.display = thumbnail.hasChildNodes() ? 'flex' : 'none';
                handleFiles(this.files);

            });

            function handleFiles(files) {
                files = [...files];
                // Remove existing images in the gallery
                clearGallery();
                // Preview the new files
                files.forEach(previewFile);
            }

            function previewFile(file) {
                let reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onloadend = function () {
                    let img = document.createElement("img");
                    img.src = reader.result;
                    // img.style.maxWidth = '320px';
                    img.style.maxWidth = "100%";
                    img.style.maxHeight = "100%";
                    img.style.objectFit = "cover";
                    dropText.style.display = "none";
                    thumbnail.appendChild(img);
                };
            }

            function clearGallery() {
                // Remove all child elements from the gallery
                while (thumbnail.firstChild) {
                    thumbnail.removeChild(thumbnail.firstChild);
                }
            }

        })();
    </script>
@endpush
