$(document).ready(function () {
    try {
        $.ajax({
            url: 'http://localhost/admin/getdata', 
            success: function(result){
                try {
                    var data = JSON.parse(result);
                    console.log(data);
                    var labels = data.map(function(item) {
                        return item.naam;
                    });
                    var values = data.map(function(item) {
                        return item.aantal;
                    });

                    // Create the chart
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Aantal reserveringen',
                                data: values,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                } catch (parseError) {
                    console.error("Fout bij het verwerken van gegevens:", parseError);
                    document.getElementById('myChart').innerHTML = 
                        '<div class="chart-error">Er is een fout opgetreden bij het laden van de grafiek.</div>';
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX fout:", error);
                document.getElementById('myChart').innerHTML = 
                    '<div class="chart-error">Kan geen verbinding maken met de server. Probeer het later opnieuw.</div>';
            }
        });
    } catch (e) {
        console.error("Algemene fout:", e);
    }
});