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

        <form id="weatherObservationForm" method="POST" action="{{ route('weather.store') }}" enctype="multipart/form-data">
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
                                    <label for="location_state" class="form-label">State</label>
                                    <input type="text" class="form-control" id="location_state" name="location_state" readonly>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="location_district" class="form-label">District</label>
                                    <input type="text" class="form-control" id="location_district" name="location_district" readonly>
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
                                <img src="/placeholder-images/rain.png" alt="Rain Icon" width="24" height="24" class="me-2">
                                <label class="form-check-label" for="weather_rain">Rain</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input weather-type" type="checkbox" id="weather_drizzle" name="weather_types[]" value="drizzle">
                                <img src="/placeholder-images/drizzle.png" alt="Drizzle Icon" width="24" height="24" class="me-2">
                                <label class="form-check-label" for="weather_drizzle">Drizzle</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input weather-type" type="checkbox" id="weather_thunder" name="weather_types[]" value="thunder_lightning">
                                <img src="/placeholder-images/thunder.png" alt="Thunder/Lightning Icon" width="24" height="24" class="me-2">
                                <label class="form-check-label" for="weather_thunder">Thunder/Lightning</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input weather-type" type="checkbox" id="weather_hail" name="weather_types[]" value="hailstorm">
                                <img src="/placeholder-images/hail.png" alt="Hailstorm Icon" width="24" height="24" class="me-2">
                                <label class="form-check-label" for="weather_hail">Hailstorm</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input weather-type incompatible-group-1" type="checkbox" id="weather_duststorm" name="weather_types[]" value="duststorm">
                                <img src="/placeholder-images/duststorm.png" alt="Duststorm Icon" width="24" height="24" class="me-2">
                                <label class="form-check-label" for="weather_duststorm">Duststorm</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input weather-type incompatible-group-1" type="checkbox" id="weather_fog" name="weather_types[]" value="fog">
                                <img src="/placeholder-images/fog.png" alt="Fog Icon" width="24" height="24" class="me-2">
                                <label class="form-check-label" for="weather_fog">Fog</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input weather-type" type="checkbox" id="weather_snow" name="weather_types[]" value="snow">
                                <img src="/placeholder-images/snow.png" alt="Snow Icon" width="24" height="24" class="me-2">
                                <label class="form-check-label" for="weather_snow">Snow</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input weather-type" type="checkbox" id="weather_gusty_wind" name="weather_types[]" value="gusty_wind">
                                <img src="/placeholder-images/wind.png" alt="Gusty Wind Icon" width="24" height="24" class="me-2">
                                <label class="form-check-label" for="weather_gusty_wind">Gusty Wind (>62km/h)</label>
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
                        <label for="media_files" class="form-label">Upload Images and Videos</label>
                        <input type="file" class="form-control" id="media_files" name="media_files[]" multiple accept="image/*,video/*">
                        <div class="form-text">You can select multiple files. Accepted formats: images and videos.</div>
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
                    'district': 'District',
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
                    'gustyWind': 'Gusty Wind (>62km/h)',
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
                    'description': 'Description',
                    'describeWeatherEvent': 'Describe the weather event in detail',
                    'descriptionPlaceholder': 'Please provide any additional details about the weather event...',
                    'mediaFiles': 'Media Files',
                    'uploadImagesVideos': 'Upload Images and Videos',
                    'multipleFilesNote': 'You can select multiple files. Accepted formats: images and videos.',
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
                    'district': 'ضلع',
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
                    'gustyWind': 'تیز ہوا (>٦٢ کلومیٹر/گھنٹہ)',
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
                    'description': 'تفصیل',
                    'describeWeatherEvent': 'موسمی واقعے کی تفصیل بیان کریں',
                    'descriptionPlaceholder': 'براہ کرم موسمی واقعے کے بارے میں کوئی اضافی تفصیلات فراہم کریں...',
                    'mediaFiles': 'میڈیا فائلیں',
                    'uploadImagesVideos': 'تصاویر اور ویڈیوز اپلوڈ کریں',
                    'multipleFilesNote': 'آپ متعدد فائلیں منتخب کر سکتے ہیں۔ قبول کردہ فارمیٹس: تصاویر اور ویڈیوز۔',
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
                mapElementByText('label[for="location_district"]', 'district');
                mapElementByText('label[for="time_zone"]', 'timeZone');
                mapElementByText('label[for="event_date"]', 'dateOfWeatherEvent');
                mapElementByText('label[for="event_time"]', 'timeOfWeatherEvent');
                
                // Map weather type labels
                mapElementByText('label[for="weather_rain"]', 'rain');
                mapElementByText('label[for="weather_drizzle"]', 'drizzle');
                mapElementByText('label[for="weather_thunder"]', 'thunderLightning');
                mapElementByText('label[for="weather_hail"]', 'hailstorm');
                mapElementByText('label[for="weather_duststorm"]', 'duststorm');
                mapElementByText('label[for="weather_fog"]', 'fog');
                mapElementByText('label[for="weather_snow"]', 'snow');
                mapElementByText('label[for="weather_gusty_wind"]', 'gustyWind');
                
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
                
                // Map descriptive text
                mapElementByText('label[for="event_description"]', 'describeWeatherEvent');
                mapElementByText('label[for="media_files"]', 'uploadImagesVideos');
                mapElementByText('#weatherTypeError', 'duststormFogError');
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
            const districtInput = document.getElementById('location_district');
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
                            fetch(`https://api.mapbox.com/geocoding/v5/mapbox.places/${longitude},${latitude}.json?access_token=${mapboxToken}&types=region,district,locality`)
                                .then(response => response.json())
                                .then(data => {
                                    if (data.features && data.features.length > 0) {
                                        // Extract state and district from features
                                        let state = '';
                                        let district = '';
                                        
                                        // Process features to find administrative levels
                                        data.features.forEach(feature => {
                                            if (feature.place_type.includes('region')) {
                                                state = feature.text;
                                            }
                                            if (feature.place_type.includes('district') || 
                                                feature.place_type.includes('locality')) {
                                                district = feature.text;
                                            }
                                        });
                                        
                                        // Set the values
                                        stateInput.value = state || 'Unknown state';
                                        districtInput.value = district || 'Unknown district';
                                        
                                        // Handle timezone - for Pakistan specifically
                                        if (data.features.some(f => f.text.includes('Islamabad') || 
                                            f.place_name.includes('Pakistan'))) {
                                            timeZoneInput.value = 'Asia/Karachi';
                                        } else {
                                            // Fallback to browser timezone
                                            timeZoneInput.value = Intl.DateTimeFormat().resolvedOptions().timeZone;
                                        }
                                        
                                        setTranslatedLocationStatus('locationDetailsRetrieved');
                                    } else {
                                        throw new Error('No location data found');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error fetching location details:', error);
                                    setTranslatedLocationStatus('errorRetrievingLocation');
                                    
                                    // Make fields editable if geocoding fails
                                    stateInput.readOnly = false;
                                    districtInput.readOnly = false;
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
                            stateInput.readOnly = false;
                            districtInput.readOnly = false;
                            timeZoneInput.readOnly = false;
                        }
                    );
                } else {
                    setTranslatedLocationStatus('geolocationNotSupported');
                    
                    // Make fields editable if geolocation is not supported
                    stateInput.readOnly = false;
                    districtInput.readOnly = false;
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

            // Form validation
            const weatherObservationForm = document.getElementById('weatherObservationForm');
            if (weatherObservationForm) {
                weatherObservationForm.addEventListener('submit', function(event) {
                    if (!checkIncompatibility()) {
                        event.preventDefault();
                    }
                    // Additional validation could be added here
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