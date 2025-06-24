<!DOCTYPE html>
<html lang="en">

<head>
    ... (unchanged head content)
</head>

<body>
    <?php
    // Using real backend data passed to the view
    $teachers = $teacherData ?? [];
    $messages = $messageData ?? [];
    $overviewData = $schoolOverview ?? [
        ['name' => 'Students', 'y' => 60],
        ['name' => 'Teachers', 'y' => 25],
        ['name' => 'Staff', 'y' => 15]
    ];
    $performanceData = $schoolPerformance ?? [85, 90, 78];
    ?>

    <h2>Teacher List</h2>
    <?php if (!empty($teachers)): ?>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Qualification</th>
                    <th>Fee</th>
                    <th>Performance</th>
                </tr>
            </thead>
            <tbody id="teacher-body">
                <?php foreach ($teachers as $user): ?>
                    <tr>
                        <td><?= $user['first_name'] ?></td>
                        <td><?= $user['subject'] ?></td>
                        <td><?= $user['qualification'] ?></td>
                        <td><?= $user['fee'] ?></td>
                        <td><?= $user['performance'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No teacher data available.</p>
    <?php endif; ?>

    <h2>Messages</h2>
    <ul id="msg-list">
        <?php if (!empty($messages)): ?>
            <?php foreach ($messages as $msg): ?>
                <li><?= $msg['username'] ?>: <?= $msg['message'] ?></li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>No messages to display.</li>
        <?php endif; ?>
    </ul>

    <h2>School Performance</h2>
    <div id="school-performance" style="height: 400px; margin-bottom: 2rem;"></div>

    <h2>School Overview</h2>
    <div id="school-overview" style="height: 400px;"></div>

    <script>
        document.querySelectorAll('.count').forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText.replace(/,/g, '');
                const increment = target / 100;
                if (count < target) {
                    counter.innerText = Math.ceil(count + increment).toLocaleString();
                    setTimeout(updateCount, 20);
                } else {
                    counter.innerText = target.toLocaleString();
                }
            };
            updateCount();
        });

        const links = document.querySelectorAll('.sidebar a');
        const hash = location.hash || '#dashboard';
        links.forEach(link => link.classList.remove('active'));
        const activeLink = document.querySelector(`.sidebar a[href="${hash}"]`);
        if (activeLink) activeLink.classList.add('active');

        Highcharts.chart('school-performance', {
            chart: {
                type: 'column',
                backgroundColor: '#1e293b'
            },
            title: {
                text: 'School Performance',
                style: {
                    color: '#f8fafc'
                }
            },
            xAxis: {
                categories: ['Math', 'Science', 'History'],
                labels: {
                    style: {
                        color: '#cbd5e1'
                    }
                }
            },
            yAxis: {
                title: {
                    text: 'Average Score',
                    style: {
                        color: '#f8fafc'
                    }
                },
                labels: {
                    style: {
                        color: '#cbd5e1'
                    }
                }
            },
            series: [{
                name: 'Score',
                data: <?= json_encode($performanceData) ?>,
                color: '#38bdf8'
            }],
            legend: {
                itemStyle: {
                    color: '#f8fafc'
                }
            },
            credits: {
                enabled: false
            }
        });

        Highcharts.chart('school-overview', {
            chart: {
                type: 'pie',
                backgroundColor: '#1e293b'
            },
            title: {
                text: 'School Overview',
                style: {
                    color: '#f8fafc'
                }
            },
            series: [{
                name: 'Users',
                data: <?= json_encode($overviewData) ?>,
                colors: ['#38bdf8', '#22c55e', '#f97316']
            }],
            legend: {
                itemStyle: {
                    color: '#f8fafc'
                }
            },
            tooltip: {
                style: {
                    color: '#f8fafc'
                }
            },
            credits: {
                enabled: false
            }
        });
    </script>
</body>

</html>