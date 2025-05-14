<!-- weather-observation-form.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Observation Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js"></script>
</head>
<body>
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
                                <input class="form-check-input" type="checkbox" id="damage_makeshift" name="damages[]" value="damage_makeshift_structures">
                                <label class="form-check-label" for="damage_makeshift">Damage to Makeshift structures (houses, cowsheds)</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="damage_reinforced" name="damages[]" value="damage_reinforced_structures">
                                <label class="form-check-label" for="damage_reinforced">Damage to Reinforced structures (houses, shelters)</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="damage_flooding" name="damages[]" value="flooding_of_land">
                                <label class="form-check-label" for="damage_flooding">Flooding of land</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="damage_livestock" name="damages[]" value="damage_to_livestock">
                                <label class="form-check-label" for="damage_livestock">Damage/Death to livestock</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="damage_humans" name="damages[]" value="damage_to_humans">
                                <label class="form-check-label" for="damage_humans">Damage/Death to Humans</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="damage_crops" name="damages[]" value="damage_to_crops">
                                <label class="form-check-label" for="damage_crops">Damage to vegetation/crops</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="damage_other" name="damages[]" value="other_damage">
                                <label class="form-check-label" for="damage_other">Other</label>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2" id="other_damage_details_container" style="display: none;">
                            <div class="form-group">
                                <label for="other_damage_details" class="form-label">Please specify other damage:</label>
                                <textarea class="form-control" id="other_damage_details" name="other_damage_details" rows="2" placeholder="Please describe the other damage..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description Section -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3>Description</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="event_description" class="form-label">Describe the weather event in detail</label>
                        <textarea class="form-control" id="event_description" name="event_description" rows="4" placeholder="Please provide any additional details about the weather event..."></textarea>
                    </div>
                </div>
            </div>

            <!-- Media Input Section -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3>Media Files</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="media_files" class="form-label">Upload Images</label>
                        <div class="d-flex flex-column">
                            <input type="file" class="form-control d-none" id="media_files" name="media_files[]" multiple accept=".jpg, .jpeg, .png, .gif, image/jpeg, image/png, image/jpg, image/gif">
                            <div class="mb-2">
                                <button type="button" id="custom_file_button" class="btn btn-outline-primary">
                                    <i class="bi bi-images me-2"></i>Add Images
                                </button>
                            </div>
                            <div class="alert alert-info py-2">
                                <i class="bi bi-info-circle me-2"></i>
                                <small id="multiple_selection_help">You can select multiple images at once or add more images by clicking the button again</small>
                            </div>
                        </div>
                        <div class="form-text">Accepted formats: jpeg, png, jpg, gif.</div>
                        <div class="mt-2">
                            <span id="selected_file_count" class="text-primary fw-bold"></span>
                        </div>
                        <div class="mt-3 mb-2" id="selected_files_list"></div>
                        <div class="mt-3" id="image_preview_container" style="display: flex; flex-wrap: wrap; gap: 10px;"></div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4">
                <button type="submit" class="btn btn-success btn-lg">Submit Report</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // LANGUAGE TRANSLATION FUNCTIONALITY
           
            // Language translations object
            const translations = {
                'en': {
                    'weatherObservationReport': 'Weather Observation Report',
                    'locationInformation': 'Location Information',
                    'getMyCurrentLocation': 'Get My Current Location',
                    'state': 'State',
                    'city': 'City',
                    'timeZone': 'Time Zone',
                    'eventDateAndTime': 'Event Date and Time',
                    'dateOfWeatherEvent': 'Date of Weather Event',
                    'timeOfWeatherEvent': 'Time of Weather Event',
                    'weatherPhenomena': 'Weather Phenomena',
                    'selectAllThatApply': 'Select all that apply',
                    'rain': 'Rain',
                    'drizzle': 'Drizzle',
                    'thunderLightning': 'Thunder/Lightning',
                    'hailstorm': 'Hailstorm',
                    'duststorm': 'Duststorm',
                    'fog': 'Fog',
                    'snow': 'Snow',
                    'gustyWind': 'Gusty Wind',
                    'smog': 'Smog',
                    'duststormFogError': 'Duststorm and Fog cannot be selected together.',
                    'damageCaused': 'Damage Caused',
                    'treeBranchesBreaking': 'Tree branches breaking',
                    'smallTreeUprooting': 'Small tree uprooting',
                    'bigTreeUprooting': 'Big tree uprooting',
                    'poleDamagedBending': 'Telephone pole / Transmission tower damaged by bending',
                    'poleUprooting': 'Telephone pole / Transmission tower uprooting',
                    'damageToMakeshiftStructures': 'Damage to Makeshift structures (houses, cowsheds)',
                    'damageToReinforcedStructures': 'Damage to Reinforced structures (houses, shelters)',
                    'floodingOfLand': 'Flooding of land',
                    'damageToLivestock': 'Damage/Death to livestock',
                    'damageToHumans': 'Damage/Death to Humans',
                    'damageToVegetationCrops': 'Damage to vegetation/crops',
                    'otherDamage': 'Other',
                    'specifyOtherDamage': 'Please specify other damage:',
                    'otherDamagePlaceholder': 'Please describe the other damage...',
                    'description': 'Description',
                    'describeWeatherEvent': 'Describe the weather event in detail',
                    'descriptionPlaceholder': 'Please provide any additional details about the weather event...',
                    'mediaFiles': 'Media Files',
                    'uploadImagesVideos': 'Upload Images',
                    'multipleFilesNote': 'Accepted formats: jpeg, png, jpg, gif.',
                    'filesSelected': 'files selected',
                    'fileSelected': 'file selected',
                    'selectImages': 'Add Images',
                    'multipleSelectionHelp': 'You can select multiple images at once or add more images by clicking the button again',
                    'submitReport': 'Submit Report',
                    'language': 'Language',
                    'requestingLocationAccess': 'Requesting location access...',
                    'locationAcquired': 'Location acquired. Fetching location details...',
                    'locationDetailsRetrieved': 'Location details successfully retrieved.',
                    'errorRetrievingLocation': 'Error retrieving location details. Please enter manually.',
                    'locationAccessDenied': 'Location access denied. Please enter location manually.',
                    'locationUnavailable': 'Location information unavailable.',
                    'locationTimeout': 'Location request timed out.',
                    'unknownLocationError': 'An unknown error occurred while getting location.',
                    'geolocationNotSupported': 'Geolocation is not supported by this browser.'
                },
                'ur': {
                    'weatherObservationReport': 'موسمی مشاہدے کی رپورٹ',
                    'locationInformation': 'مقام کی معلومات',
                    'getMyCurrentLocation': 'میرا موجودہ مقام حاصل کریں',
                    'state': 'ریاست',
                    'city': 'شہر',
                    'timeZone': 'ٹائم زون',
                    'eventDateAndTime': 'واقعے کی تاریخ اور وقت',
                    'dateOfWeatherEvent': 'موسمی واقعے کی تاریخ',
                    'timeOfWeatherEvent': 'موسمی واقعے کا وقت',
                    'weatherPhenomena': 'موسمی مظاہر',
                    'selectAllThatApply': 'جو لاگو ہوں وہ منتخب کریں',
                    'rain': 'بارش',
                    'drizzle': 'پھوار',
                    'thunderLightning': 'گرج چمک',
                    'hailstorm': 'ژالہ باری',
                    'duststorm': 'آندھی',
                    'fog': 'دھند',
                    'snow': 'برف',
                    'gustyWind': 'تیز ہوا',
                    'smog': 'سموگ',
                    'duststormFogError': 'آندھی اور دھند ایک ساتھ منتخب نہیں کی جا سکتی۔',
                    'damageCaused': 'پہنچنے والا نقصان',
                    'treeBranchesBreaking': 'درختوں کی شاخیں ٹوٹنا',
                    'smallTreeUprooting': 'چھوٹے درخت اکھڑنا',
                    'bigTreeUprooting': 'بڑے درخت اکھڑنا',
                    'poleDamagedBending': 'ٹیلیفون پول / ٹرانسمیشن ٹاور کا مڑنا',
                    'poleUprooting': 'ٹیلیفون پول / ٹرانسمیشن ٹاور کا اکھڑنا',
                    'damageToMakeshiftStructures': 'عارضی ڈھانچوں کو نقصان (گھر، گائے کے شیڈ)',
                    'damageToReinforcedStructures': 'مضبوط ڈھانچوں کو نقصان (گھر، پناہ گاہیں)',
                    'floodingOfLand': 'زمین پر سیلاب',
                    'damageToLivestock': 'مویشیوں کو نقصان/موت',
                    'damageToHumans': 'انسانوں کو نقصان/موت',
                    'damageToVegetationCrops': 'نباتات/فصلوں کو نقصان',
                    'otherDamage': 'دیگر',
                    'specifyOtherDamage': 'براہ کرم دیگر نقصان کی وضاحت کریں:',
                    'otherDamagePlaceholder': 'براہ کرم دیگر نقصان کی تفصیل بیان کریں...',
                    'description': 'تفصیل',
                    'describeWeatherEvent': 'موسمی واقعے کی تفصیل بیان کریں',
                    'descriptionPlaceholder': 'براہ کرم موسمی واقعے کے بارے میں کوئی اضافی تفصیلات فراہم کریں...',
                    'mediaFiles': 'میڈیا فائلیں',
                    'uploadImagesVideos': 'تصاویر اپلوڈ کریں',
                    'multipleFilesNote': 'قبول کردہ فارمیٹس: jpeg، png، jpg، gif۔',
                    'filesSelected': 'فائلیں منتخب کی گئیں',
                    'fileSelected': 'فائل منتخب کی گئی',
                    'selectImages': 'تصاویر شامل کریں',
                    'multipleSelectionHelp': 'آپ ایک ساتھ متعدد تصاویر منتخب کر سکتے ہیں یا بٹن پر دوبارہ کلک کر کے مزید تصاویر شامل کر سکتے ہیں',
                    'submitReport': 'رپورٹ جمع کرائیں',
                    'language': 'زبان',
                    'requestingLocationAccess': 'مقام تک رسائی کی درخواست کر رہا ہے...',
                    'locationAcquired': 'مقام حاصل کر لیا گیا۔ مقام کی تفصیلات حاصل کر رہا ہے...',
                    'locationDetailsRetrieved': 'مقام کی تفصیلات کامیابی سے حاصل کر لی گئیں۔',
                    'errorRetrievingLocation': 'مقام کی تفصیلات حاصل کرنے میں خرابی۔ براہ کرم دستی طور پر درج کریں۔',
                    'locationAccessDenied': 'مقام تک رسائی مسترد کر دی گئی۔ براہ کرم مقام دستی طور پر درج کریں۔',
                    'locationUnavailable': 'مقام کی معلومات دستیاب نہیں ہیں۔',
                    'locationTimeout': 'مقام کی درخواست کا وقت ختم ہو گیا۔',
                    'unknownLocationError': 'مقام حاصل کرتے وقت ایک نامعلوم خرابی پیش آئی۔',
                    'geolocationNotSupported': 'جیو لوکیشن اس براؤزر کے ذریعے تعاون یافتہ نہیں ہے۔'
                }
            };

            // Initialize elements map (for caching translated elements)
            const elementsMap = new Map();

            // Get language dropdown and language buttons
            const languageDropdown = document.getElementById('languageDropdown');
            const languageButtons = document.querySelectorAll('[data-language]');

            // Set current language (default: English)
            let currentLanguage = 'en';

            // Apply translations based on selected language
            function applyTranslations(lang) {
                // Update current language
                currentLanguage = lang;

                // Update dropdown button text
                if (languageDropdown) {
                    languageDropdown.innerHTML = `<i class="bi bi-globe"></i> ${translations[lang]['language']}`;
                }

                // Update active class on language buttons
                languageButtons.forEach(button => {
                    if (button.dataset.language === lang) {
                        button.classList.add('active');
                    } else {
                        button.classList.remove('active');
                    }
                });

                // If first time applying translations, build elements map
                if (elementsMap.size === 0) {
                    mapElementsForTranslation();
                }

                // Apply translations to all mapped elements
                for (const [key, elements] of elementsMap.entries()) {
                    if (translations[lang][key]) {
                        elements.forEach(el => {
                            if (el.tagName === 'INPUT' && el.type === 'text' || el.tagName === 'TEXTAREA') {
                                if (el.placeholder) {
                                    el.placeholder = translations[lang][key];
                                }
                            } else if (el.dataset.translateAttr === 'innerHTML') {
                                el.innerHTML = translations[lang][key];
                            } else {
                                el.textContent = translations[lang][key];
                            }
                        });
                    }
                }
            }

            // Map all translatable elements on the page
            function mapElementsForTranslation() {
                // Map headings
                mapElementByText('h1', 'weatherObservationReport');
                
                // Map card headers
                mapElementByText('.card-header h3', 'locationInformation', 0);
                mapElementByText('.card-header h3', 'eventDateAndTime', 1);
                mapElementByText('.card-header h3', 'weatherPhenomena', 2);
                mapElementByText('.card-header h3', 'damageCaused', 3);
                mapElementByText('.card-header h3', 'description', 4);
                mapElementByText('.card-header h3', 'mediaFiles', 5);
                
                // Map buttons
                mapElementByText('#getLocationBtn', 'getMyCurrentLocation');
                mapElementByText('button[type="submit"]', 'submitReport');
                
                // Map form labels
                mapElementByText('label[for="location_state"]', 'state');
                mapElementByText('label[for="location_city"]', 'city');
                mapElementByText('label[for="time_zone"]', 'timeZone');
                mapElementByText('label[for="event_date"]', 'dateOfWeatherEvent');
                mapElementByText('label[for="event_time"]', 'timeOfWeatherEvent');
                
                // Map buttons
                mapElementByText('#custom_file_button', 'selectImages');
                
                // Map weather type labels
                mapElementByText('label[for="weather_rain"]', 'rain');
                mapElementByText('label[for="weather_drizzle"]', 'drizzle');
                mapElementByText('label[for="weather_thunder"]', 'thunderLightning');
                mapElementByText('label[for="weather_hail"]', 'hailstorm');
                mapElementByText('label[for="weather_duststorm"]', 'duststorm');
                mapElementByText('label[for="weather_fog"]', 'fog');
                mapElementByText('label[for="weather_snow"]', 'snow');
                mapElementByText('label[for="weather_gusty_wind"]', 'gustyWind');
                mapElementByText('label[for="weather_smog"]', 'smog');
                
                // Map damage labels
                mapElementByText('label[for="damage_tree_branches"]', 'treeBranchesBreaking');
                mapElementByText('label[for="damage_small_tree"]', 'smallTreeUprooting');
                mapElementByText('label[for="damage_big_tree"]', 'bigTreeUprooting');
                mapElementByText('label[for="damage_pole_bend"]', 'poleDamagedBending');
                mapElementByText('label[for="damage_pole_uproot"]', 'poleUprooting');
                mapElementByText('label[for="damage_makeshift"]', 'damageToMakeshiftStructures');
                mapElementByText('label[for="damage_reinforced"]', 'damageToReinforcedStructures');
                mapElementByText('label[for="damage_flooding"]', 'floodingOfLand');
                mapElementByText('label[for="damage_livestock"]', 'damageToLivestock');
                mapElementByText('label[for="damage_humans"]', 'damageToHumans');
                mapElementByText('label[for="damage_crops"]', 'damageToVegetationCrops');
                mapElementByText('label[for="damage_other"]', 'otherDamage');
                
                // Map descriptive text
                mapElementByText('label[for="event_description"]', 'describeWeatherEvent');
                mapElementByText('label[for="media_files"]', 'uploadImagesVideos');
                mapElementByText('#weatherTypeError', 'duststormFogError');
                mapElementByText('#multiple_selection_help', 'multipleSelectionHelp');
                mapElementByAttribute('#event_description', 'placeholder', 'descriptionPlaceholder');
                
                // Map "Select all that apply" text
                const selectAllTexts = document.querySelectorAll('.card-header p.text-muted');
                selectAllTexts.forEach(el => {
                    addToElementsMap('selectAllThatApply', el);
                });
                
                // Map form text helper
                const helperText = document.querySelector('.form-text');
                if (helperText) {
                    addToElementsMap('multipleFilesNote', helperText);
                }
                
                // Map status messages that might be set dynamically
                addToElementsMap('requestingLocationAccess', { dataset: { translateText: 'Requesting location access...' }});
                addToElementsMap('locationAcquired', { dataset: { translateText: 'Location acquired. Fetching location details...' }});
                addToElementsMap('locationDetailsRetrieved', { dataset: { translateText: 'Location details successfully retrieved.' }});
                addToElementsMap('errorRetrievingLocation', { dataset: { translateText: 'Error retrieving location details. Please enter manually.' }});
                addToElementsMap('locationAccessDenied', { dataset: { translateText: 'Location access denied. Please enter location manually.' }});
                addToElementsMap('locationUnavailable', { dataset: { translateText: 'Location information unavailable.' }});
                addToElementsMap('locationTimeout', { dataset: { translateText: 'Location request timed out.' }});
                addToElementsMap('unknownLocationError', { dataset: { translateText: 'An unknown error occurred while getting location.' }});
                addToElementsMap('geolocationNotSupported', { dataset: { translateText: 'Geolocation is not supported by this browser.' }});
                
                // Map other damage details
                mapElementByText('label[for="other_damage_details"]', 'specifyOtherDamage');
                mapElementByAttribute('#other_damage_details', 'placeholder', 'otherDamagePlaceholder');
            }

            // Helper function to map elements by their text content
            function mapElementByText(selector, translationKey, index = null) {
                const elements = document.querySelectorAll(selector);
                if (elements.length > 0) {
                    if (index !== null && elements[index]) {
                        addToElementsMap(translationKey, elements[index]);
                    } else {
                        elements.forEach(el => {
                            addToElementsMap(translationKey, el);
                        });
                    }
                }
            }

            // Helper function to map elements by attribute
            function mapElementByAttribute(selector, attribute, translationKey) {
                const element = document.querySelector(selector);
                if (element) {
                    element.dataset.translateAttr = attribute;
                    addToElementsMap(translationKey, element);
                }
            }

            // Add element to the elements map
            function addToElementsMap(key, element) {
                if (!elementsMap.has(key)) {
                    elementsMap.set(key, []);
                }
                elementsMap.get(key).push(element);
            }

            // GEOLOCATION & MAP FUNCTIONALITY
            
            // Geolocation handling
            const getLocationBtn = document.getElementById('getLocationBtn');
            const locationStatus = document.getElementById('locationStatus');
            const stateInput = document.getElementById('location_state');
            const cityInput = document.getElementById('location_city');
            const timeZoneInput = document.getElementById('time_zone');

            // Mapbox token (should ideally be passed from your Laravel backend)
            const mapboxToken = '{{ config("services.mapbox.token") }}';
            let map = null;
            let marker = null;

            // Initialize empty map
            function initializeMap() {
                if (typeof mapboxgl !== 'undefined') {
                    mapboxgl.accessToken = mapboxToken;
                    map = new mapboxgl.Map({
                        container: 'locationMap',
                        style: 'mapbox://styles/mapbox/streets-v12',
                        center: [0, 0], // Default center (will be updated)
                        zoom: 1 // Default zoom (will be updated)
                    });
                }
            }

            // Initialize the map
            initializeMap();

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

            // Handle location button click with translation support
            getLocationBtn.addEventListener('click', function() {
                // Set the location status with translation
                const setTranslatedLocationStatus = (messageKey) => {
                    locationStatus.textContent = translations[currentLanguage][messageKey];
                    locationStatus.dataset.messageKey = messageKey;
                };
                
                setTranslatedLocationStatus('requestingLocationAccess');
                
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        // Success callback
                        function(position) {
                            const latitude = position.coords.latitude;
                            const longitude = position.coords.longitude;
                            
                            // Update map with location
                            updateMapLocation(longitude, latitude);
                            
                            setTranslatedLocationStatus('locationAcquired');
                            
                            // Use Mapbox Geocoding API for reverse geocoding
                            const mapboxToken = mapboxgl.accessToken;
                            fetch(`https://api.mapbox.com/geocoding/v5/mapbox.places/${longitude},${latitude}.json?access_token=${mapboxToken}&types=place,region`)
                                .then(response => response.json())
                                .then(data => {
                                    if (data.features && data.features.length > 0) {
                                        // Extract city and state from features
                                        let city = '';
                                        let state = '';
                                        
                                        // Process features to find city and state
                                        data.features.forEach(feature => {
                                            if (feature.place_type.includes('place')) {
                                                city = feature.text;
                                            }
                                            if (feature.place_type.includes('region')) {
                                                state = feature.text;
                                            }
                                        });
                                        
                                        // Set the values
                                        cityInput.value = city || 'Unknown city';
                                        stateInput.value = state || 'Unknown state';
                                        
                                        // Get timezone in IANA region format
                                        const regionTimeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
                                        
                                        // Special case for Pakistan
                                        let timeZoneRegion = regionTimeZone;
                                        if (data.features.some(f => f.text.includes('Islamabad') || 
                                            f.place_name.includes('Pakistan'))) {
                                            timeZoneRegion = 'Asia/Karachi';
                                        }
                                        
                                        // Get timezone offset in GMT format
                                        const date = new Date();
                                        const offsetMinutes = date.getTimezoneOffset();
                                        const offsetHours = Math.abs(Math.floor(offsetMinutes / 60));
                                        const offsetMinutesRemainder = Math.abs(offsetMinutes % 60);
                                        const offsetSign = offsetMinutes <= 0 ? '+' : '-';
                                        const gmtString = `GMT${offsetSign}${offsetHours}${offsetMinutesRemainder > 0 ? ':' + offsetMinutesRemainder.toString().padStart(2, '0') : ''}`;
                                        
                                        // Set combined timezone value
                                        timeZoneInput.value = `${timeZoneRegion} (${gmtString})`;
                                        
                                        setTranslatedLocationStatus('locationDetailsRetrieved');
                                    } else {
                                        throw new Error('No location data found');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error fetching location details:', error);
                                    setTranslatedLocationStatus('errorRetrievingLocation');
                                    
                                    // Make fields editable if geocoding fails
                                    cityInput.readOnly = false;
                                    stateInput.readOnly = false;
                                    timeZoneInput.readOnly = false;
                                });
                        },
                        // Error callback
                        function(error) {
                            switch (error.code) {
                                case error.PERMISSION_DENIED:
                                    setTranslatedLocationStatus('locationAccessDenied');
                                    break;
                                case error.POSITION_UNAVAILABLE:
                                    setTranslatedLocationStatus('locationUnavailable');
                                    break;
                                case error.TIMEOUT:
                                    setTranslatedLocationStatus('locationTimeout');
                                    break;
                                default:
                                    setTranslatedLocationStatus('unknownLocationError');
                            }
                            
                            // Make fields editable if geolocation fails
                            cityInput.readOnly = false;
                            stateInput.readOnly = false;
                            timeZoneInput.readOnly = false;
                        }
                    );
                } else {
                    setTranslatedLocationStatus('geolocationNotSupported');
                    
                    // Make fields editable if geolocation is not supported
                    cityInput.readOnly = false;
                    stateInput.readOnly = false;
                    timeZoneInput.readOnly = false;
                }
            });

            // FORM VALIDATION
            
            // Weather phenomena incompatibility logic
            const dustStormCheckbox = document.getElementById('weather_duststorm');
            const fogCheckbox = document.getElementById('weather_fog');
            const weatherTypeError = document.getElementById('weatherTypeError');

            function checkIncompatibility() {
                if (dustStormCheckbox && fogCheckbox) {
                    if (dustStormCheckbox.checked && fogCheckbox.checked) {
                        weatherTypeError.style.display = 'block';
                        return false;
                    } else {
                        weatherTypeError.style.display = 'none';
                        return true;
                    }
                }
                return true;
            }

            if (dustStormCheckbox && fogCheckbox) {
                dustStormCheckbox.addEventListener('change', checkIncompatibility);
                fogCheckbox.addEventListener('change', checkIncompatibility);
            }

            // Handle the "Other" damage option
            const damageOtherCheckbox = document.getElementById('damage_other');
            const otherDamageDetailsContainer = document.getElementById('other_damage_details_container');
            const otherDamageDetails = document.getElementById('other_damage_details');
            
            if (damageOtherCheckbox && otherDamageDetailsContainer) {
                damageOtherCheckbox.addEventListener('change', function() {
                    if (this.checked) {
                        otherDamageDetailsContainer.style.display = 'block';
                        otherDamageDetails.setAttribute('required', 'required');
                    } else {
                        otherDamageDetailsContainer.style.display = 'none';
                        otherDamageDetails.removeAttribute('required');
                        otherDamageDetails.value = '';
                    }
                });
            }

            // Image upload handling
            const mediaFilesInput = document.getElementById('media_files');
            const customFileButton = document.getElementById('custom_file_button');
            const selectedFileCount = document.getElementById('selected_file_count');
            const selectedFilesList = document.getElementById('selected_files_list');
            const imagePreviewContainer = document.getElementById('image_preview_container');
            
            // Store uploaded files information for previews and display
            const uploadedFiles = [];
            
            // Add click handler for the add images button
            if (customFileButton && mediaFilesInput) {
                customFileButton.addEventListener('click', function() {
                    // Set multiple attribute to ensure multiple file selection
                    mediaFilesInput.setAttribute('multiple', 'multiple');
                    mediaFilesInput.click();
                });
            }
            
            // Handle file selection change from the file input
            if (mediaFilesInput) {
                mediaFilesInput.addEventListener('change', function(event) {
                    if (event.target.files && event.target.files.length > 0) {
                        // Add newly selected files to our tracking array (without clearing previous ones)
                        Array.from(event.target.files).forEach(file => {
                            uploadedFiles.push({
                                file: file,
                                id: Date.now() + Math.random().toString(36).substring(2, 10)
                            });
                        });
                        
                        // Update UI
                        updateFilesUI();
                    }
                });
            }
            
            // Function to update UI based on current files
            function updateFilesUI() {
                // Clear previous UI
                imagePreviewContainer.innerHTML = '';
                selectedFilesList.innerHTML = '';
                
                // Update file count display
                if (uploadedFiles.length > 0) {
                    const selectionText = uploadedFiles.length === 1 
                        ? `${uploadedFiles.length} ${translations[currentLanguage]['fileSelected']}` 
                        : `${uploadedFiles.length} ${translations[currentLanguage]['filesSelected']}`;
                    selectedFileCount.textContent = selectionText;
                    selectedFileCount.style.fontSize = '1.1rem';
                    
                    // Create file list with improved styling
                    const fileList = document.createElement('ul');
                    fileList.className = 'list-group';
                    
                    uploadedFiles.forEach((fileObj, index) => {
                        const file = fileObj.file;
                        const fileId = fileObj.id;
                        
                        const listItem = document.createElement('li');
                        listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
                        listItem.dataset.fileId = fileId;
                        
                        // Create filename display
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
                        
                        // Create actions container (filesize and delete button)
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
                        
                        // Add delete button event handler
                        removeButton.addEventListener('click', function() {
                            // Remove file from tracking array
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
                        
                        // Generate preview for this file
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
                }
                
                // Update the hidden file input for form submission by creating a new FileList-like object
                updateFormFileInput();
            }
            
            // Create a hidden file input with the current files before form submission
            function updateFormFileInput() {
                // When form is submitted, we'll create a FormData object with all files
                // from our uploadedFiles array in the form submission handler
                
                // Clear existing input and create a new one to ensure it's fresh
                const existingInput = document.getElementById('media_files');
                const form = existingInput.parentNode.parentNode.parentNode.parentNode.parentNode;
                
                // Add a hidden field to signal that we have files
                const filesCountField = document.getElementById('files_count') || document.createElement('input');
                filesCountField.type = 'hidden';
                filesCountField.id = 'files_count';
                filesCountField.name = 'files_count';
                filesCountField.value = uploadedFiles.length;
                form.appendChild(filesCountField);
            }
            
            // Form validation and submission
            const weatherObservationForm = document.getElementById('weatherObservationForm');
            if (weatherObservationForm) {
                weatherObservationForm.addEventListener('submit', function(event) {
                    // Check incompatibility first
                    if (!checkIncompatibility()) {
                        event.preventDefault();
                        return;
                    }
                    
                    // If we have uploaded files, handle them with custom submission
                    if (uploadedFiles.length > 0) {
                        // Create a FormData object from the form
                        const formData = new FormData(this);
                        
                        // Remove any existing files
                        formData.delete('media_files[]');
                        
                        // Add each file from our tracking array
                        uploadedFiles.forEach(fileObj => {
                            formData.append('media_files[]', fileObj.file);
                        });
                        
                        // Replace the form submission with our custom AJAX request
                        event.preventDefault();
                        
                        // Disable submit button to prevent double submission
                        const submitBtn = document.querySelector('button[type="submit"]');
                        if (submitBtn) {
                            submitBtn.disabled = true;
                            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submitting...';
                        }
                        
                        // Submit the form using fetch API
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
                            // Redirect to the success page or show a success message
                            if (data.redirect) {
                                window.location.href = data.redirect;
                            } else {
                                // Show success message and reset form
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
                    // If no files, just let the form submit normally
                });
            }

            // LANGUAGE SELECTION HANDLING
            
            // Handle language selection
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>