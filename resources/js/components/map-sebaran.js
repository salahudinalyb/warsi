import jsVectorMap from 'jsvectormap';
import 'jsvectormap/dist/maps/world';
import 'jsvectormap/dist/jsvectormap.min.css';

export const initMapSebaran = () => {
    const el = document.querySelector('#mapSebaran');
    if (!el) return;

    const all = JSON.parse(el.dataset.all || '[]');
    const colors = JSON.parse(el.dataset.colors || '{}');
    const byId = {};
    all.forEach((r) => { byId[r.id] = r; });

    const isDark = document.documentElement.classList.contains('dark');

    const toMarker = (r) => ({
        coords: [r.lat, r.lng],
        name: `${r.nama} — ${r.wilayah}`,
        style: {
            initial: {
                fill: colors[r.kategori] || '#1f6b46',
                stroke: isDark ? '#0C110B' : '#FFFFFF',
                strokeWidth: 2,
                r: 6,
                fillOpacity: 1,
            },
            hover: { fill: colors[r.kategori] || '#1f6b46', fillOpacity: 0.8 },
        },
    });

    const DEFAULT_FOCUS = { coords: [-0.9, 100.6], scale: 26, animate: false };

    const resetBtn = document.querySelector('#mapSebaranReset');
    const setResetVisible = (visible) => {
        if (!resetBtn) return;
        resetBtn.classList.toggle('opacity-0', !visible);
        resetBtn.classList.toggle('pointer-events-none', !visible);
    };

    let suppressNextViewportChange = true;

    const map = new jsVectorMap({
        selector: '#mapSebaran',
        map: 'world',
        zoomButtons: true,
        zoomInButton: '#mapSebaranZoomIn',
        zoomOutButton: '#mapSebaranZoomOut',
        zoomOnScroll: true,
        zoomAnimate: true,
        zoomMax: 48,
        zoomMin: 1,
        zoomStep: 1.5,
        selectedRegions: [],
        regionsSelectable: false,
        regionStyle: {
            initial: {
                fill: isDark ? '#1D2939' : '#E4E7EC',
                stroke: isDark ? '#101828' : '#FFFFFF',
                strokeWidth: 0.5,
            },
            hover: { fill: isDark ? '#344054' : '#D0D5DD' },
        },
        markersSelectable: false,
        markers: all.map(toMarker),
        focusOn: DEFAULT_FOCUS,
        onViewportChange: () => {
            if (suppressNextViewportChange) {
                suppressNextViewportChange = false;
                setResetVisible(false);
                return;
            }
            setResetVisible(true);
        },
    });

    // dragging pans the map without emitting onViewportChange, so track it ourselves
    let dragStartX = 0;
    let dragStartY = 0;
    let dragging = false;
    el.addEventListener('mousedown', (e) => {
        dragging = true;
        dragStartX = e.pageX;
        dragStartY = e.pageY;
    });
    window.addEventListener('mouseup', (e) => {
        if (!dragging) return;
        dragging = false;
        const moved = Math.abs(e.pageX - dragStartX) + Math.abs(e.pageY - dragStartY);
        if (moved > 3) setResetVisible(true);
    });

    window.updateMapSebaranMarkers = (rows) => {
        map.removeMarkers();
        map.addMarkers(rows.map((r) => toMarker(byId[r.id] || r)));
    };

    window.resetMapSebaran = () => {
        suppressNextViewportChange = true;
        setResetVisible(false);
        map.setFocus({ ...DEFAULT_FOCUS, animate: true });
    };

    return map;
};

export default initMapSebaran;
