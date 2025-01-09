export const loadGoogleMapsApi = (apiKey) => {
    return new Promise((resolve, reject) => {
        if (typeof window.google !== 'undefined' && window.google.maps) {
            // Google Maps API is already loaded
            resolve(window.google);
            return;
        }

        // Create script element
        const script = document.createElement('script');
        script.src = `https://maps.googleapis.com/maps/api/js?key=${apiKey}&libraries=places`;
        script.async = true;
        script.defer = true;

        // Attach event listeners
        script.onload = () => resolve(window.google);
        script.onerror = (error) => reject(new Error('Failed to load Google Maps API'));

        // Append to the document
        document.head.appendChild(script);
    });
};