/**
 * Dynamic dependent dropdown for regions and stations
 * 
 * This script handles the dynamic loading of stations based on the selected region
 * in both registration and profile update forms.
 */
document.addEventListener('DOMContentLoaded', function() {
    const regionSelect = document.querySelector('#region_id');
    const stationSelect = document.querySelector('#station_id');
    
    if (!regionSelect || !stationSelect) {
        return; // Exit if elements don't exist on this page
    }
    
    // Function to load stations based on selected region
    function loadStations(regionId, selectedStationId = null) {
        // Clear existing options except the first one (placeholder)
        while (stationSelect.options.length > 1) {
            stationSelect.remove(1);
        }
        
        // Disable select until new options are loaded
        stationSelect.disabled = true;
        
        // Add loading indicator
        const firstOption = stationSelect.options[0];
        firstOption.text = 'Loading stations...';
        
        fetch(`/api/stations/by-region?region_id=${regionId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(stations => {
                // Reset first option text
                firstOption.text = 'Select Station';
                
                // Add station options
                stations.forEach(station => {
                    const option = new Option(station.name, station.id);
                    
                    // If this station matches the previously selected one, select it
                    if (selectedStationId && station.id == selectedStationId) {
                        option.selected = true;
                    }
                    
                    stationSelect.add(option);
                });
                
                // Enable select again
                stationSelect.disabled = false;
            })
            .catch(error => {
                console.error('Error loading stations:', error);
                firstOption.text = 'Error loading stations';
                
                // Create a retry option
                const retryOption = new Option('Click to retry', '');
                stationSelect.add(retryOption);
                
                // Enable select to allow retry
                stationSelect.disabled = false;
            });
    }
    
    // Load stations when region selection changes
    regionSelect.addEventListener('change', function() {
        const regionId = this.value;
        
        if (regionId) {
            loadStations(regionId);
        } else {
            // Reset and disable station select if no region is selected
            while (stationSelect.options.length > 1) {
                stationSelect.remove(1);
            }
            stationSelect.disabled = true;
        }
    });
    
    // If region is already selected on page load (e.g., when editing profile)
    // load the corresponding stations and preselect the user's station
    if (regionSelect.value) {
        // Check if there's a hidden input with the current station value (for edit forms)
        const currentStationInput = document.querySelector('input[name="current_station_id"]');
        const currentStationId = currentStationInput ? currentStationInput.value : null;
        
        loadStations(regionSelect.value, currentStationId);
    } else {
        // Disable station select initially if no region is selected
        stationSelect.disabled = true;
    }
    
    // If the station select is clicked and shows "Error loading stations", retry loading
    stationSelect.addEventListener('click', function() {
        if (this.options[0].text === 'Error loading stations' && regionSelect.value) {
            loadStations(regionSelect.value);
        }
    });
});