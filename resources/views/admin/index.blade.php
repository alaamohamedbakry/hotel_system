@extends('admin.dashboard')
@section('cont')
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <!-- First Box -->
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner" id="total_booking">
                        <h3>0</h3> <!-- القيمة الافتراضية -->
                        <p>Bookings</p>
                    </div>

                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>


            <!-- Second Box -->
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner" id="total_rooms">
                        <h3>0</h3>
                        <p>Total Rooms</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Third Box -->
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner" id="total_user">
                        <h3>0</h3>
                        <p>User Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Fourth Box -->
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner" id="total_hotels">
                        <h3>0</h3>
                        <p>Total Hotels</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- ./row -->

        <!-- Row with Line and Bar Chart -->
        <div class="row">
            <!-- Line Chart and Bar Chart in same row -->
            <div class="col-lg-6 col-md-6">
                <!-- LINE CHART -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Total Booking</h3>
                    </div>
                    <div class="box-body">
                        <div style="max-width: 100%; height: 300px;">
                            <canvas id="lineChart"></canvas>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <!-- STAFF BAR CHART -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Total Staff</h3>
                    </div>
                    <div class="box-body">
                        <div style="max-width: 100%; height: 300px;">
                            <canvas id="BarChart"></canvas>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <!-- STAFF BAR CHART -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Total rooms</h3>
                    </div>
                    <div class="box-body">
                        <div style="max-width: 100%; height: 300px;">
                            <canvas id="pieChart"></canvas>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
        <!-- ./row -->

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Fetch and draw Line Chart for Total Bookings
            fetch('/chart-bookings')
                .then(response => response.json())
                .then(data => {
                    const ctx = document.getElementById('lineChart').getContext('2d');
                    const chart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: data.labels, // التواريخ
                            datasets: [{
                                label: 'Total Bookings',
                                data: data.data, // عدد الحجوزات
                                borderColor: 'rgba(75, 192, 192, 1)',
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderWidth: 2,
                                tension: 0.4, // تقليل حدة الخط
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                title: {
                                    display: true,
                                    text: 'Total Bookings Over Time'
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                }
                            }
                        }
                    });
                })
                .catch(error => console.error('Error:', error));
        </script>

        <script>
            // Fetch and draw Bar Chart for Total Staff
            fetch('/chart-staff')
                .then(response => response.json())
                .then(data => {
                    const ctx = document.getElementById('BarChart').getContext('2d');
                    const chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: 'Staff Count by Hotel',
                                data: data.data,
                                backgroundColor: '#36A2EB',
                                borderColor: '#36A2EB',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                title: {
                                    display: true,
                                    text: 'Staff Distribution by Hotel'
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                }
                            }
                        }
                    });
                })
                .catch(error => console.error('Error:', error));
        </script>
        <script>
            fetch('/chart-rooms')
                .then(response => response.json())
                .then(data => {
                    const ctx = document.getElementById('pieChart').getContext('2d');
                    const chart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: data.labels, // أسماء الفنادق
                            datasets: [{
                                label: 'Room Count by Hotel',
                                data: data.data, // عدد الغرف في كل فندق
                                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#FF9F40', '#4BC0C0'],
                                borderColor: ['#fff', '#fff', '#fff', '#fff', '#fff'],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                title: {
                                    display: true,
                                    text: 'Rooms Distribution by Hotel'
                                }
                            }
                        }
                    });
                })
                .catch(error => console.error('Error:', error));
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            $(document).ready(function() {
                        $.ajax({
                            url: '/total-bookings',
                            method: 'GET',
                            success: function(response) {
                                $('#total_booking h3').text(response.data);
                            },
                            error: function() {
                                console.log('Error fetching total customers');
                            }
                        });
                        $.ajax({
                            url: '/total-rooms',
                            method: 'GET',
                            success: function(response) {
                                $('#total_rooms h3').text(response.data);
                            },
                            error: function() {
                                console.log('Error fetching total customers');
                            }
                        });
                        $.ajax({
                            url: '/total-user',
                            method: 'GET',
                            success: function(response) {
                                $('#total_user h3').text(response.data);
                            },
                            error: function() {
                                console.log('Error fetching total customers');
                            }
                        });
                        $.ajax({
                            url: '/total-hotels',
                            method: 'GET',
                            success: function(response) {
                                $('#total_hotels h3').text(response.data);
                            },
                            error: function() {
                                console.log('Error fetching total customers');
                            }
                        });
            });
        </script>
    @endsection
