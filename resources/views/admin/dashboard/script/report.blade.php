<script>

var tags = [
  @forelse($tags as $tag)
    "{{ $tag->name }}",
  @empty
    "no tags"
  @endforelse
];  

var data = [
  @forelse($tags as $tag)
    "{{ $tag->percentage() }}",
  @empty
    "1"
  @endforelse
];

var backgroundColor = [
  @forelse($tags as $tag)
    '{{ '#'.$tag->color }}',
  @empty
    '#4e73df'
  @endforelse
];

// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut', // doughnut or pie
  data: {
    labels: tags,
    datasets: [{
      data: data,
      backgroundColor: backgroundColor,
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 50, // 50 or 80
  },
});
</script>
