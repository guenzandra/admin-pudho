<!---resources/views/admin/anti-dropdown/mapview.blade.php-->
@extends('admin.layout')

@section('content')
<div class="container-fluid p-0">
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Anti-Squatting Map View</h4>
                    <p class="text-muted mb-0">📍 Pending | 🔍 Under Investigation | ✅ Resolved</p>
                </div>
                <div class="card-body p-0">
                    <!-- Map Container -->
                    <div id="map" style="height: 80vh; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<!-- Leaflet CSS (free) -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    #map {
        height: 80vh;
        width: 100%;
        z-index: 1;
    }
    .custom-marker {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        color: white;
        font-weight: bold;
        box-shadow: 0 2px 5px rgba(0,0,0,0.3);
    }
    .marker-pending { background-color: #dc3545; }  /* Red */
    .marker-investigation { background-color: #ffc107; color: #000; }  /* Yellow */
    .marker-resolved { background-color: #28a745; }  /* Green */
    .info-window {
        padding: 8px;
        max-width: 200px;
    }
    .info-window strong {
        display: block;
        margin-bottom: 5px;
        font-size: 14px;
    }
    .info-window small {
        color: #666;
        font-size: 11px;
    }
</style>
@endpush

@push('scripts')
<!-- Leaflet JavaScript (free) -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Default center (Laguna, Philippines)
        const defaultLocation = [14.1008, 121.0794];
        
        // Initialize the map - FREE, no API key needed!
        const map = L.map('map').setView(defaultLocation, 12);
        
        // Add OpenStreetMap tiles (completely free)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19
        }).addTo(map);
        
        console.log('Map initialized successfully!');
        
        // For testing: Add sample markers
        addSampleMarkers();
    });
    
    // Function to add sample markers (for testing)
    function addSampleMarkers() {
        // Sample data - pending, investigation, resolved
        const sampleReports = [
            {
                lat: 14.1008,
                lng: 121.0794,
                status: 'pending',
                description: 'Squatting report in Barangay San Antonio',
                date: '2026-03-05',
                id: '001'
            },
            {
                lat: 14.1108,
                lng: 121.0894,
                status: 'under_investigation',
                description: 'Illegal structure near creek',
                date: '2026-03-04',
                id: '002'
            },
            {
                lat: 14.0908,
                lng: 121.0694,
                status: 'resolved',
                description: 'Case settled, structure removed',
                date: '2026-03-01',
                id: '003'
            }
        ];
        
        sampleReports.forEach(report => {
            addMarker(report);
        });
    }
    
    // Function to add a marker based on status
    function addMarker(report) {
        // Determine marker color based on status
        let markerClass = 'marker-pending';
        let statusText = 'Pending';
        let iconChar = '📍';
        
        switch(report.status) {
            case 'pending':
                markerClass = 'marker-pending';
                statusText = 'Pending';
                iconChar = '⚠️';
                break;
            case 'under_investigation':
                markerClass = 'marker-investigation';
                statusText = 'Under Investigation';
                iconChar = '🔍';
                break;
            case 'resolved':
                markerClass = 'marker-resolved';
                statusText = 'Resolved';
                iconChar = '✅';
                break;
        }
        
        // Create custom marker icon
        const customIcon = L.divIcon({
            className: 'custom-marker ' + markerClass,
            html: iconChar,
            iconSize: [30, 30],
            popupAnchor: [0, -15]
        });
        
        // Create marker
        const marker = L.marker([report.lat, report.lng], { icon: customIcon }).addTo(map);
        
        // Create popup content
        const popupContent = `
            <div class="info-window">
                <strong>Report #${report.id}</strong>
                <div style="color: ${markerClass === 'marker-pending' ? '#dc3545' : (markerClass === 'marker-investigation' ? '#856404' : '#28a745')}; font-weight: bold;">
                    Status: ${statusText}
                </div>
                <small>Date: ${new Date(report.date).toLocaleDateString()}</small>
                <p style="margin-top: 5px; margin-bottom: 0;">${report.description}</p>
            </div>
        `;
        
        marker.bindPopup(popupContent);
    }
    
    // Function to load real data from database (use this later)
    function loadReportsFromDatabase() {
        // You'll replace this with actual data from Laravel
        fetch('/api/reports-with-coordinates')
            .then(response => response.json())
            .then(reports => {
                reports.forEach(report => {
                    addMarker({
                        lat: parseFloat(report.latitude),
                        lng: parseFloat(report.longitude),
                        status: report.status,
                        description: report.description,
                        date: report.date_reported,
                        id: report.report_id
                    });
                });
            });
    }
</script>
@endpush