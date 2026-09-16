export const initChartKategori = () => {
    const el = document.querySelector('#chartKategori');
    if (!el) return;

    const categories = JSON.parse(el.dataset.categories || '[]');
    const colors = JSON.parse(el.dataset.colors || '[]');
    const counts = JSON.parse(el.dataset.counts || '[]');
    const isDark = document.documentElement.classList.contains('dark');

    const options = {
        series: [{ name: 'Titik Kegiatan', data: counts }],
        chart: {
            fontFamily: 'Manrope, sans-serif',
            type: 'bar',
            height: 220,
            toolbar: { show: false },
        },
        plotOptions: {
            bar: {
                horizontal: true,
                distributed: true,
                borderRadius: 6,
                barHeight: '55%',
                dataLabels: { position: 'top' },
            },
        },
        colors,
        dataLabels: {
            enabled: true,
            offsetX: 8,
            dropShadow: { enabled: false },
            style: { colors: [isDark ? '#F9FAFB' : '#101828'], fontSize: '12px', fontWeight: 700 },
            formatter: (val) => new Intl.NumberFormat('id-ID').format(val),
        },
        grid: {
            borderColor: isDark ? '#1D2939' : '#F2F4F7',
            xaxis: { lines: { show: true } },
            yaxis: { lines: { show: false } },
        },
        xaxis: {
            categories,
            min: 0,
            tickAmount: Math.max(1, Math.max(...counts, 1)),
            axisBorder: { show: false },
            axisTicks: { show: false },
            labels: { style: { colors: isDark ? '#98A2B3' : '#667085' }, formatter: (val) => Math.round(val) },
        },
        yaxis: {
            labels: { style: { colors: isDark ? '#E4E7EC' : '#1D2939', fontSize: '13px', fontWeight: 600 } },
        },
        legend: { show: false },
        tooltip: {
            theme: isDark ? 'dark' : 'light',
            y: { formatter: (val) => `${val} titik` },
        },
    };

    const chart = new window.ApexCharts(el, options);
    chart.render();

    window.updateChartKategoriData = (newCounts) => {
        chart.updateOptions({ xaxis: { min: 0, tickAmount: Math.max(1, Math.max(...newCounts, 1)) } });
        chart.updateSeries([{ data: newCounts }]);
    };

    return chart;
};

export default initChartKategori;
