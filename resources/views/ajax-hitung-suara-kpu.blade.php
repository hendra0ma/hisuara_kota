<?php


use App\Models\DataCrowdC1;
use Illuminate\Support\Facades\DB;
$paslon = DB::table('paslon')->get();
$item = DB::table('districts')->where('id',$request->id)->first();
$dataChart = [];
 ?>


  <tr onclick='check("{{ Crypt::encrypt($item->id) }}")'>
      <td class="align-middle">
          <a
              href="{{ url('/') }}/administrator/kpu_kecamatan/{{ Crypt::encrypt($item->id) }}">{{ $item->name }}</a>
      </td>
      @foreach ($paslon as $cd)
          <?php $saksi_dataa = DataCrowdC1::where('paslon_id', $cd->id)
              ->where('district_id', $item->id)
              ->sum('voice'); 
              $dataChart[$cd->id] = $saksi_dataa;
              
              ?>

          <td class="align-middle text-end">{{ $saksi_dataa }}</td>
      @endforeach
  </tr>


     <script>
            // Sample data
            $(document).ready(function() {
                var chartData = {
                    columns: [
                        @foreach ($paslon as $pas)
                          
                                ['data{{ $pas->id }}', {{ $dataChart[$cd->id] }}],
                        @endforeach
                    ],
                    type: 'pie', // Type of chart (line chart in this case)
                    colors: {
                        @foreach ($paslon as $pas)
                            data{{ $pas->id }}: '{{ $pas->color }}', // Color for the third data series
                        @endforeach
                    },
                    names: {
                        // name of each serie
                        @foreach ($paslon as $pas)
                            data{{ $pas->id}}: " {{ $pas->candidate }} - {{ $pas->deputy_candidate }}",
                        @endforeach
                    },
                    legend: {
                        show: true, //hide legend
                    },
                    axis: {
                        rotated: true,
                    },
                };

                // Chart configuration
                var chartConfig = {
                    bindto: '#charture-{{ $item->id }}', // ID of the chart container
                    data: chartData,
                    pie: {
                        label: {
                            format: function(value, ratio, id) {
                                return d3.format('.1%')(ratio); // Show percentage on the labels
                            }
                        }
                    }
                };

                // Generate the chart
                var chart = c3.generate(chartConfig);
            })
        </script>