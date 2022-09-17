@foreach ($chart->plugins as $plugin)
    @include($chart->pluginsViews[$plugin])
@endforeach

<script {!! $chart->displayScriptAttributes() !!}>
    var ctvChart = document.getElementById('{{ $chart->id }}');

    function {{ $chart->id }}_create(data) {
        {{ $chart->id }}_rendered = true;
        document.getElementById("{{ $chart->id }}_loader").style.display = 'none';
        document.getElementById("{{ $chart->id }}").style.display = 'block';
        window.{{ $chart->id }} = new ApexCharts(document.querySelector("#{{ $chart->id }}"), {
            {!! $chart->formatOptions(true, true) !!},
            series: data,

            @if (!isset($chart->options['xaxis']))
                xaxis: {
                    categories: {!! $chart->formatLabels() !!}
                },
            @endif

        });
        {{ $chart->id }}.render();
    }
    @if ($chart->api_url)
        let {{ $chart->id }}_refresh = function(url) {
            document.getElementById("{{ $chart->id }}").style.display = 'none';
            document.getElementById("{{ $chart->id }}_loader").style.display = 'flex';
            if (typeof url !== 'undefined') {
                {{ $chart->id }}_api_url = url;
            }
            fetch({{ $chart->id }}_api_url)
                .then(data => data.json())
                .then(data => {
                    document.getElementById("{{ $chart->id }}_loader").style.display = 'none';
                    document.getElementById("{{ $chart->id }}").style.display = 'block';
                    {{ $chart->id }}.data.datasets = data;
                    {{ $chart->id }}.update();
                });
        };
    @endif
    @include('charts::init')
</script>
