export const initChartEmisi = () => {
    const el = document.querySelector('#chartEmisiTereduksi');
    if (!el) return;

    const series = JSON.parse(el.dataset.series || '[]');
    const categories = JSON.parse(el.dataset.categories || '[]');
    const isDark = document.documentElement.classList.contains('dark');

    const options = {
        series: [{ name: 'Emisi tereduksi (kumulatif)', data: series }],
        legend: { show: false },
        colors: ['#1f6b46'],
        chart: {
            fontFamily: 'Manrope, sans-serif',
            height: '100%',
            type: 'area',
            toolbar: { show: false },
        },
        fill: {
            gradient: {
                enabled: true,
                opacityFrom: 0.45,
                opacityTo: 0,
            },
        },
        stroke: {
            curve: 'smooth',
            width: 2,
        },
        markers: {
            size: 0,
            hover: { size: 5 },
        },
        grid: {
            borderColor: isDark ? '#1D2939' : '#F2F4F7',
            xaxis: { lines: { show: false } },
            yaxis: { lines: { show: true } },
        },
        dataLabels: { enabled: false },
        tooltip: {
            theme: isDark ? 'dark' : 'light',
            y: {
                formatter: (val) => new Intl.NumberFormat('id-ID').format(val) + ' tCO₂e',
            },
        },
        xaxis: {
            type: 'category',
            categories,
            axisBorder: { show: false },
            axisTicks: { show: false },
            labels: { style: { colors: isDark ? '#98A2B3' : '#667085' } },
        },
        yaxis: {
            labels: {
                formatter: (val) => new Intl.NumberFormat('id-ID', { notation: 'compact' }).format(val),
                style: { colors: isDark ? '#98A2B3' : '#667085' },
            },
        },
    };

    const chart = new window.ApexCharts(el, options);
    chart.render();
    return chart;
};

export default initChartEmisi;
