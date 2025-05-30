@extends('layouts.app')

@push('styles')
<link href="https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<script src="https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js"></script>
@endpush

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Weather Observation Report</h1>
        <div class="dropdown">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-globe"></i> Language
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                <li><button class="dropdown-item active" type="button" data-language="en">English</button></li>
                <li><button class="dropdown-item" type="button" data-language="ur">اردو</button></li>
            </ul>
        </div>
    </div>

    <form id="weatherObservationForm" method="POST" action="{{ route('weather.observation.store') }}" enctype="multipart/form-data">
        @csrf
        
        <!-- Location Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h3>Location Information</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <button type="button" id="getLocationBtn" class="btn btn-primary mb-3">Get My Current Location</button>
                            <div id="locationStatus" class="text-muted"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="location_city" class="form-label">City</label>
                                <input type="text" class="form-control" id="location_city" name="location_city" readonly>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="location_state" class="form-label">State</label>
                                <input type="text" class="form-control" id="location_state" name="location_state" readonly>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="time_zone" class="form-label">Time Zone</label>
                                <input type="text" class="form-control" id="time_zone" name="time_zone" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="locationMap" style="width: 100%; height: 300px; border-radius: 4px;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Event Date and Time Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h3>Event Date and Time</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="event_date" class="form-label">Date of Weather Event</label>
                        <input type="date" class="form-control" id="event_date" name="event_date" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="event_time" class="form-label">Time of Weather Event</label>
                        <input type="time" class="form-control" id="event_time" name="event_time" required>
                    </div>
                </div>
            </div>
        </div>

        <!-- Weather Phenomena Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h3>Weather Phenomena</h3>
                <p class="text-muted">Select all that apply</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <div class="form-check">
                            <input class="form-check-input weather-type" type="checkbox" id="weather_rain" name="weather_types[]" value="rain">
                            <img src="{{ asset('images/rain.jpg') }}" alt="Rain Icon" width="24" height="24" class="me-2">
                            <label class="form-check-label" for="weather_rain">Rain</label>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-check">
                            <input class="form-check-input weather-type" type="checkbox" id="weather_drizzle" name="weather_types[]" value="drizzle">
                            <img src="{{ asset('images/drizzle.jpg') }}" alt="Drizzle Icon" width="24" height="24" class="me-2">
                            <label class="form-check-label" for="weather_drizzle">Drizzle</label>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-check">
                            <input class="form-check-input weather-type" type="checkbox" id="weather_thunder" name="weather_types[]" value="thunder_lightning">
                            <img src="{{ asset('images/thunder.jpg') }}" alt="Thunder/Lightning Icon" width="24" height="24" class="me-2">
                            <label class="form-check-label" for="weather_thunder">Thunder/Lightning</label>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-check">
                            <input class="form-check-input weather-type" type="checkbox" id="weather_hail" name="weather_types[]" value="hailstorm">
                            <img src="{{ asset('images/hail.jpg') }}" alt="Hailstorm Icon" width="24" height="24" class="me-2">
                            <label class="form-check-label" for="weather_hail">Hailstorm</label>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-check">
                            <input class="form-check-input weather-type incompatible-group-1" type="checkbox" id="weather_duststorm" name="weather_types[]" value="duststorm">
                            <img src="{{ asset('images/duststorm.webp') }}" alt="Duststorm Icon" width="24" height="24" class="me-2">
                            <label class="form-check-label" for="weather_duststorm">Duststorm</label>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-check">
                            <input class="form-check-input weather-type incompatible-group-1" type="checkbox" id="weather_fog" name="weather_types[]" value="fog">
                            <img src="{{ asset('images/fog.jpg') }}" alt="Fog Icon" width="24" height="24" class="me-2">
                            <label class="form-check-label" for="weather_fog">Fog</label>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-check">
                            <input class="form-check-input weather-type" type="checkbox" id="weather_snow" name="weather_types[]" value="snow">
                            <img src="{{ asset('images/snow.jpg') }}" alt="Snow Icon" width="24" height="24" class="me-2">
                            <label class="form-check-label" for="weather_snow">Snow</label>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-check">
                            <input class="form-check-input weather-type" type="checkbox" id="weather_gusty_wind" name="weather_types[]" value="gusty_wind">
                            <img src="{{ asset('images/wind.webp') }}" alt="Gusty Wind Icon" width="24" height="24" class="me-2">
                            <label class="form-check-label" for="weather_gusty_wind">Gusty Wind</label>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-check">
                            <input class="form-check-input weather-type" type="checkbox" id="weather_smog" name="weather_types[]" value="smog">
                            <img src="{{ asset('images/smog.jpg') }}" alt="Smog Icon" width="24" height="24" class="me-2">
                            <label class="form-check-label" for="weather_smog">Smog</label>
                        </div>
                    </div>
                </div>
                <div id="weatherTypeError" class="text-danger mt-2" style="display: none;">
                    Duststorm and Fog cannot be selected together.
                </div>
            </div>
        </div>

        <!-- Damage Caused Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h3>Damage Caused</h3>
                <p class="text-muted">Select all that apply</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="damage_tree_branches" name="damages[]" value="tree_branches_breaking">
                            <label class="form-check-label" for="damage_tree_branches">Tree branches breaking</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="damage_small_tree" name="damages[]" value="small_tree_uprooting">
                            <label class="form-check-label" for="damage_small_tree">Small tree uprooting</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="damage_big_tree" name="damages[]" value="big_tree_uprooting">
                            <label class="form-check-label" for="damage_big_tree">Big tree uprooting</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="damage_pole_bend" name="damages[]" value="pole_damaged_bending">
                            <label class="form-check-label" for="damage_pole_bend">Telephone pole / Transmission tower damaged by bending</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="damage_pole_uproot" name="damages[]" value="pole_uprooting">
                            <label class="form-check-label" for="damage_pole_uproot">Telephone pole / Transmission tower uprooting</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="damage_billboard" name="damages[]" value="billboard_signboard_damage">
                            <label class="form-check-label" for="damage_billboard">Billboard/Signboard damage</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="damage_roof" name="damages[]" value="roof_damage">
                            <label class="form-check-label" for="damage_roof">Roof damage</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="damage_vehicle" name="damages[]" value="vehicle_damage">
                            <label class="form-check-label" for="damage_vehicle">Vehicle damage</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="damage_window" name="damages[]" value="window_damage">
                            <label class="form-check-label" for="damage_window">Window damage</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="damage_crops" name="damages[]" value="crop_damage">
                            <label class="form-check-label" for="damage_crops">Crop damage</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="damage_livestock" name="damages[]" value="livestock_injury">
                            <label class="form-check-label" for="damage_livestock">Livestock injury/death</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="damage_human" name="damages[]" value="human_injury">
                            <label class="form-check-label" for="damage_human">Human injury/fatality</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="damage_power" name="damages[]" value="power_disruption">
                            <label class="form-check-label" for="damage_power">Power disruption</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="damage_traffic" name="damages[]" value="traffic_disruption">
                            <label class="form-check-label" for="damage_traffic">Traffic disruption</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="damage_flight" name="damages[]" value="flight_disruption">
                            <label class="form-check-label" for="damage_flight">Flight disruption</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="damage_communication" name="damages[]" value="communication_disruption">
                            <label class="form-check-label" for="damage_communication">Communication disruption</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="damage_flooding" name="damages[]" value="flooding">
                            <label class="form-check-label" for="damage_flooding">Flooding</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="damage_other" name="damages[]" value="other_damage">
                            <label class="form-check-label" for="damage_other">Other</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="damage_none" name="damages[]" value="no_damage">
                            <label class="form-check-label" for="damage_none">No damage</label>
                        </div>
                    </div>
                </div>
                
                <!-- Other damage details field -->
                <div class="mt-3" id="other_damage_details_wrapper" style="display: none;">
                    <label for="other_damage_details" class="form-label">Please specify other damage details:</label>
                    <textarea class="form-control" id="other_damage_details" name="other_damage_details" rows="3" placeholder="Describe the other damage..."></textarea>
                </div>
            </div>
        </div>

        <!-- Event Description Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h3>Event Description</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="event_description" class="form-label">Brief Description of the Weather Event</label>
                    <textarea class="form-control" id="event_description" name="event_description" rows="4" placeholder="Describe what you observed during the weather event..."></textarea>
                </div>
            </div>
        </div>

        <!-- Media Upload Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h3>Media Upload</h3>
                <p class="text-muted">Upload photos or videos related to the weather event (Optional)</p>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="media_files" class="form-label">Select Files</label>
                    <input type="file" class="form-control" id="media_files" name="media_files[]" multiple accept="image/*,video/*">
                    <div class="form-text">Supported formats: JPEG, PNG, GIF, MP4, MOV. Maximum file size: 10MB each.</div>
                </div>
                
                <!-- Selected Files Display -->
                <div id="selectedFiles" class="mb-3" style="display: none;">
                    <h6>Selected Files: <span id="selectedFileCount"></span></h6>
                    <div id="selectedFilesList"></div>
                </div>
                
                <!-- Image Preview -->
                <div id="imagePreview" class="d-flex flex-wrap align-items-center" style="gap: 10px;"></div>
            </div>
        </div>

        <!-- Form Submission -->
        <div class="d-grid gap-2 col-6 mx-auto mb-4">
            <button type="submit" class="btn btn-primary btn-lg">Submit Report</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Weather observation form loaded');
        
        // Check if mapboxgl is loaded
        if (typeof mapboxgl === 'undefined') {
            console.error('Mapbox GL JS not loaded');
            document.getElementById('locationStatus').textContent = 'Map service unavailable';
            document.getElementById('locationStatus').className = 'text-danger';
            return;
        }

        // Initialize map with error handling
        try {
            mapboxgl.accessToken = '{{ config("services.mapbox.token") }}';
            
            const map = new mapboxgl.Map({
                container: 'locationMap',
                style: 'mapbox://styles/mapbox/streets-v12',
                center: [0, 0], // Default center (will be updated)
                zoom: 1 // Default zoom (will be updated)
            });

            let marker;

            // Wait for map to load
            map.on('load', function() {
                console.log('Map loaded successfully');
            });

            map.on('error', function(e) {
                console.error('Map error:', e);
                document.getElementById('locationStatus').textContent = 'Map loading failed';
                document.getElementById('locationStatus').className = 'text-danger';
            });

            // Function to update map with user's location
            function updateMapLocation(longitude, latitude) {
                if (!map) return;
                
                // Update map center and zoom
                map.flyTo({
                    center: [longitude, latitude],
                    zoom: 14,
                    essential: true
                });
                
                // Remove existing marker if any
                if (marker) {
                    marker.remove();
                }
                
                // Add new marker
                marker = new mapboxgl.Marker({
                    color: "#FF0000"
                })
                    .setLngLat([longitude, latitude])
                    .addTo(map);
                    
                // Add coordinates as hidden inputs
                if (!document.getElementById('latitude')) {
                    const latInput = document.createElement('input');
                    latInput.type = 'hidden';
                    latInput.id = 'latitude';
                    latInput.name = 'latitude';
                    latInput.value = latitude;
                    document.getElementById('weatherObservationForm').appendChild(latInput);
                    
                    const lngInput = document.createElement('input');
                    lngInput.type = 'hidden';
                    lngInput.id = 'longitude';
                    lngInput.name = 'longitude';
                    lngInput.value = longitude;
                    document.getElementById('weatherObservationForm').appendChild(lngInput);
                } else {
                    document.getElementById('latitude').value = latitude;
                    document.getElementById('longitude').value = longitude;
                }
            }

            // Get location button handler
            document.getElementById('getLocationBtn').addEventListener('click', function() {
                const statusDiv = document.getElementById('locationStatus');
                const button = this;
                
                button.disabled = true;
                button.textContent = 'Getting location...';
                statusDiv.textContent = 'Requesting location access...';
                statusDiv.className = 'text-muted';
                
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        function(position) {
                            console.log('Location obtained:', position.coords);
                            
                            const lat = position.coords.latitude;
                            const lng = position.coords.longitude;
                            
                            // Update map
                            updateMapLocation(lng, lat);
                            
                            // Reverse geocoding
                            fetch(`https://api.mapbox.com/geocoding/v5/mapbox.places/${lng},${lat}.json?access_token=${mapboxgl.accessToken}`)
                                .then(response => {
                                    if (!response.ok) {
                                        throw new Error('Geocoding request failed');
                                    }
                                    return response.json();
                                })
                                .then(data => {
                                    console.log('Geocoding data:', data);
                                    
                                    if (data.features && data.features.length > 0) {
                                        const feature = data.features[0];
                                        const context = feature.context || [];
                                        
                                        // Extract city and state
                                        let city = '';
                                        let state = '';
                                        
                                        // Try to get from place name first
                                        if (feature.place_name) {
                                            const parts = feature.place_name.split(', ');
                                            city = parts[0] || '';
                                            state = parts[1] || '';
                                        }
                                        
                                        // Fill in missing info from context
                                        context.forEach(ctx => {
                                            if (ctx.id.includes('place') && !city) {
                                                city = ctx.text;
                                            }
                                            if (ctx.id.includes('region') && !state) {
                                                state = ctx.text;
                                            }
                                        });
                                        
                                        document.getElementById('location_city').value = city;
                                        document.getElementById('location_state').value = state;
                                        
                                        // Get timezone
                                        const timeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
                                        document.getElementById('time_zone').value = timeZone;
                                        
                                        statusDiv.textContent = 'Location retrieved successfully!';
                                        statusDiv.className = 'text-success';
                                        
                                        button.textContent = 'Location Retrieved';
                                        button.disabled = false;
                                        button.classList.remove('btn-primary');
                                        button.classList.add('btn-success');
                                    } else {
                                        throw new Error('No location data found');
                                    }
                                })
                                .catch(error => {
                                    console.error('Geocoding error:', error);
                                    statusDiv.textContent = 'Location retrieved, but address lookup failed.';
                                    statusDiv.className = 'text-warning';
                                    
                                    button.disabled = false;
                                    button.textContent = 'Get My Current Location';
                                });
                        },
                        function(error) {
                            console.error('Geolocation error:', error);
                            
                            let errorMessage = 'Location access failed.';
                            switch(error.code) {
                                case error.PERMISSION_DENIED:
                                    errorMessage = 'Location access denied by user.';
                                    break;
                                case error.POSITION_UNAVAILABLE:
                                    errorMessage = 'Location information is unavailable.';
                                    break;
                                case error.TIMEOUT:
                                    errorMessage = 'Location request timeout.';
                                    break;
                            }
                            
                            statusDiv.textContent = errorMessage;
                            statusDiv.className = 'text-danger';
                            button.disabled = false;
                            button.textContent = 'Get My Current Location';
                        },
                        {
                            enableHighAccuracy: true,
                            timeout: 10000,
                            maximumAge: 60000
                        }
                    );
                } else {
                    statusDiv.textContent = 'Geolocation is not supported by this browser.';
                    statusDiv.className = 'text-danger';
                    button.disabled = false;
                    button.textContent = 'Get My Current Location';
                }
            });

        } catch (error) {
            console.error('Map initialization error:', error);
            document.getElementById('locationStatus').textContent = 'Map initialization failed';
            document.getElementById('locationStatus').className = 'text-danger';
        }

        // Weather type incompatibility check
        function checkIncompatibility() {
            const group1 = document.querySelectorAll('.incompatible-group-1:checked');
            if (group1.length > 1) {
                document.getElementById('weatherTypeError').style.display = 'block';
                return false;
            }
            document.getElementById('weatherTypeError').style.display = 'none';
            return true;
        }

        // Add event listeners to weather type checkboxes
        document.querySelectorAll('.weather-type').forEach(checkbox => {
            checkbox.addEventListener('change', checkIncompatibility);
        });

        // Damage handling
        const damageCheckboxes = document.querySelectorAll('input[name="damages[]"]');
        const otherDamageCheckbox = document.getElementById('damage_other');
        const noDamageCheckbox = document.getElementById('damage_none');
        const otherDamageWrapper = document.getElementById('other_damage_details_wrapper');

        damageCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                if (this === noDamageCheckbox && this.checked) {
                    // Uncheck all other damage checkboxes
                    damageCheckboxes.forEach(cb => {
                        if (cb !== noDamageCheckbox) {
                            cb.checked = false;
                        }
                    });
                    otherDamageWrapper.style.display = 'none';
                } else if (this !== noDamageCheckbox && this.checked) {
                    // Uncheck "No damage"
                    noDamageCheckbox.checked = false;
                }

                // Show/hide other damage details
                otherDamageWrapper.style.display = otherDamageCheckbox.checked ? 'block' : 'none';
            });
        });

        // File upload handling
        const fileInput = document.getElementById('media_files');
        const selectedFilesDiv = document.getElementById('selectedFiles');
        const selectedFileCount = document.getElementById('selectedFileCount');
        const selectedFilesList = document.getElementById('selectedFilesList');
        const imagePreviewContainer = document.getElementById('imagePreview');
        const languageButtons = document.querySelectorAll('[data-language]');

        let uploadedFiles = [];

        // Handle file selection
        fileInput.addEventListener('change', function() {
            Array.from(this.files).forEach(file => {
                uploadedFiles.push({
                    file: file,
                    id: Date.now() + Math.random()
                });
            });
            updateFilesUI();
        });

        function updateFilesUI() {
            // Clear previous displays
            selectedFilesList.innerHTML = '';
            imagePreviewContainer.innerHTML = '';
            
            if (uploadedFiles.length > 0) {
                selectedFilesDiv.style.display = 'block';
                selectedFileCount.textContent = `(${uploadedFiles.length})`;
                
                // Create file list
                const fileList = document.createElement('ul');
                fileList.className = 'list-group';
                
                uploadedFiles.forEach((fileObj, index) => {
                    const file = fileObj.file;
                    const fileId = fileObj.id;
                    
                    const listItem = document.createElement('li');
                    listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
                    listItem.dataset.fileId = fileId;
                    
                    const fileInfo = document.createElement('div');
                    fileInfo.className = 'd-flex align-items-center';
                    
                    const fileIcon = document.createElement('i');
                    fileIcon.className = 'bi bi-file-earmark-image me-2';
                    fileIcon.style.fontSize = '1.2rem';
                    
                    const fileName = document.createElement('span');
                    fileName.textContent = file.name;
                    
                    fileInfo.appendChild(fileIcon);
                    fileInfo.appendChild(fileName);
                    listItem.appendChild(fileInfo);
                    
                    const actionsContainer = document.createElement('div');
                    actionsContainer.className = 'd-flex align-items-center';
                    
                    const badge = document.createElement('span');
                    badge.className = 'badge bg-primary me-2';
                    badge.textContent = `${(file.size / 1024).toFixed(1)} KB`;
                    
                    const removeButton = document.createElement('button');
                    removeButton.className = 'btn btn-sm btn-outline-danger';
                    removeButton.innerHTML = '<i class="bi bi-trash"></i>';
                    removeButton.type = 'button';
                    removeButton.title = 'Remove this file';
                    
                    removeButton.addEventListener('click', function() {
                        const fileIndex = uploadedFiles.findIndex(f => f.id === fileId);
                        if (fileIndex !== -1) {
                            uploadedFiles.splice(fileIndex, 1);
                            updateFilesUI();
                        }
                    });
                    
                    actionsContainer.appendChild(badge);
                    actionsContainer.appendChild(removeButton);
                    listItem.appendChild(actionsContainer);
                    
                    fileList.appendChild(listItem);
                    
                    // Generate preview for images
                    if (file.type.match('image.*')) {
                        const reader = new FileReader();
                        
                        reader.onload = function(e) {
                            const imgWrapper = document.createElement('div');
                            imgWrapper.className = 'image-preview';
                            imgWrapper.style.position = 'relative';
                            imgWrapper.style.margin = '5px';
                            imgWrapper.dataset.fileId = fileId;
                            
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.style.width = '120px';
                            img.style.height = '120px';
                            img.style.objectFit = 'cover';
                            img.style.borderRadius = '4px';
                            img.style.boxShadow = '0 2px 5px rgba(0,0,0,0.2)';
                            
                            imgWrapper.appendChild(img);
                            imagePreviewContainer.appendChild(imgWrapper);
                        };
                        
                        reader.readAsDataURL(file);
                    }
                });
                
                selectedFilesList.appendChild(fileList);
            } else {
                selectedFileCount.textContent = '';
                selectedFilesDiv.style.display = 'none';
            }
        }

        // Form submission handling
        const weatherObservationForm = document.getElementById('weatherObservationForm');
        if (weatherObservationForm) {
            weatherObservationForm.addEventListener('submit', function(event) {
                if (!checkIncompatibility()) {
                    event.preventDefault();
                    return;
                }
                
                if (uploadedFiles.length > 0) {
                    const formData = new FormData(this);
                    
                    formData.delete('media_files[]');
                    
                    uploadedFiles.forEach(fileObj => {
                        formData.append('media_files[]', fileObj.file);
                    });
                    
                    event.preventDefault();
                    
                    const submitBtn = document.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submitting...';
                    }
                    
                    fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Form submission failed');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.redirect) {
                            window.location.href = data.redirect;
                        } else {
                            alert('Weather observation submitted successfully!');
                            weatherObservationForm.reset();
                            uploadedFiles.length = 0;
                            updateFilesUI();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while submitting the form. Please try again.');
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = 'Submit Report';
                        }
                    });
                }
            });
        }

        // Language handling (simplified)
        const translations = {
            en: {
                title: "Weather Observation Report",
                // Add more translations as needed
            },
            ur: {
                title: "موسمی مشاہدہ رپورٹ",
                // Add more translations as needed
            }
        };

        function applyTranslations(language) {
            // Simple implementation - extend as needed
            if (translations[language]) {
                document.querySelector('h1').textContent = translations[language].title;
            }
            
            // Update active button
            languageButtons.forEach(btn => {
                btn.classList.remove('active');
                if (btn.dataset.language === language) {
                    btn.classList.add('active');
                }
            });
        }

        languageButtons.forEach(button => {
            button.addEventListener('click', function() {
                const language = this.dataset.language;
                applyTranslations(language);
            });
        });

        // Initialize with English
        applyTranslations('en');
    });
</script>
@endpush