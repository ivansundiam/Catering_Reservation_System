<div class="w-full" x-data="{ 
    hours: @entangle('hours'), 
    minutes: @entangle('minutes'), 
    selectedHour: @entangle('selectedHour'),
    selectedMinute: @entangle('selectedMinute'),
    selectedPeriod: @entangle('selectedPeriod'),
    selectedTime: @entangle('selectedTime'),
    }">
    <x-label for="time" required>Time:</x-label>
    <x-input type="text" class="w-full" id="" x-model="selectedTime" readonly />
    @php
    // Convert the selectedTime string to a valid time format (HH:MM)
        $timeValue = date('H:i', strtotime($selectedTime));
    @endphp

    <x-input type="time" name="time" class="hidden w-full" id="" :value="$timeValue" />
    
    <x-input-error for="time" />

    <div class="flex justify-center pt-3 shadow-lg bg-gray-50">
        <div class="w-16 h-[15rem] mx-2 overflow-scroll no-scrollbar" id="hourContainer">
            <div id="start" class="block w-full my-1 py-28">
            </div>
            @foreach ($hours as $hour)
            <button type="button" 
                    x-on:click="selectedHour = '{{ $hour }}'; $wire.selectHour({{ $hour }})"
                    x-bind:class="{
                        'block w-full py-2 my-1 hover:bg-primary-light ': true,
                        'selectedTime bg-primary text-white hover:!bg-primary-hover': selectedHour == '{{ $hour }}'
                    }">
                {{ $hour }}
            </button>
            <div class="border border-gray-300"></div>
        @endforeach
            <div id="end" class="block w-full my-1 py-28">
            </div>
        </div>

        <div class="w-16 mx-2 h-[15rem] overflow-scroll no-scrollbar" id="minuteContainer" >
            <div id="start" class="block w-full my-1 py-28"></div>
            @foreach ($minutes as $minute)
                <button type="button" 
                        x-on:click="selectedMinute = '{{ $minute }}'; $wire.selectMinute({{ $minute }})"
                        x-bind:class="{
                            'block w-full py-2 my-1 hover:bg-primary-light ': true,
                            'selectedTime bg-primary text-white hover:!bg-primary-hover': selectedMinute == '{{ $minute }}'
                        }">
                    {{ str_pad($minute, 2, '0', STR_PAD_LEFT) }}
                </button>
                <div class="border border-gray-300"></div>
            @endforeach
            <div id="end" class="block w-full my-1 py-28"></div>
        </div>
        <div class="w-16 mx-2">
            <button type="button" x-on:click="selectedPeriod = 'AM'; $wire.selectPeriod('AM')" 
                x-bind:class="{
                        'block w-full py-2 my-1 hover:bg-primary-light ': true,
                        'selectedTime bg-primary text-white hover:!bg-primary-hover': selectedPeriod == 'AM'
                }">AM</button>
            <div class="border border-gray-300"></div>    
            <button type="button" x-on:click="selectedPeriod = 'PM'; $wire.selectPeriod('PM')" 
                x-bind:class="{
                        'block w-full py-2 my-1 hover:bg-primary-light ': true,
                        'selectedTime bg-primary text-white hover:!bg-primary-hover': selectedPeriod == 'PM'
                }">PM</button>
        </div>
    </div>

    @push('scripts')
        <script>   
            window.addEventListener('DOMContentLoaded', (event) => {
                const hourContainer = document.getElementById('hourContainer');
                const minuteContainer = document.getElementById('minuteContainer');
                
                const hourContainerHeight = hourContainer.scrollHeight;
                const minuteContainerHeight = minuteContainer.scrollHeight;

                const selectedHourButton = hourContainer.querySelector('.selectedTime');
                const selectedMinuteButton = minuteContainer.querySelector('.selectedTime');

                hourContainer.addEventListener('scroll', function() {
                    // Check if scroll reached the bottom
                    if (hourContainer.scrollTop >= hourContainerHeight - hourContainer.clientHeight) {
                        // Scroll to the top
                        hourContainer.scrollTop = 1;
                    }
                    // Check if scroll reached the top
                    if (hourContainer.scrollTop === 0) {
                        // Scroll to the bottom
                        hourContainer.scrollTop = hourContainerHeight - hourContainer.clientHeight - 1;
                    }
                });

                minuteContainer.addEventListener('scroll', function() {
                    // Check if scroll reached the bottom
                    if (minuteContainer.scrollTop >= minuteContainerHeight - minuteContainer.clientHeight) {
                        minuteContainer.scrollTop = 1;
                    }
                    // Check if scroll reached the top
                    if (minuteContainer.scrollTop === 0) {
                        minuteContainer.scrollTop = minuteContainerHeight - minuteContainer.clientHeight - 1;
                    }
                });

                if (selectedHourButton) {
                    // Scroll the container to the position of the selected hour button
                    hourContainer.scrollTop = selectedHourButton.offsetTop - hourContainer.offsetTop - 3;
                }

                if (selectedMinuteButton) {
                    // Scroll the container to the position of the selected hour button
                    minuteContainer.scrollTop = selectedMinuteButton.offsetTop - minuteContainer.offsetTop - 3;
                }
            });
        </script>
    
    @endpush

</div>
