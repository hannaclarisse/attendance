$(document).ready(function () {
    console.log("check1");
    setInterval(() => {
        $("#timeNow").html(moment().format('MMMM Do YYYY, h:mm:ss a'));
    }, 1000);

    $('.timein').click(function(e) {
        console.log("beforeinsert");
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "dashboardProcess.php",
            data: {
                insertTimeIn: true
            },
            dataType: "json",
            success: function(response) {
                location.reload()
                console.log("naginsert?");
            }, error: function(error){
                console.error(error);
            }
        });
    });

    $('.timeout').click(function(e) {
        console.log("beforeinsert");
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "dashboardProcess.php",
            data: {
                insertTimeOut: true
            },
            dataType: "json",
            success: function(response) {
                location.reload()
                console.log("naginsert?");
            }, error: function(error){
                console.error(error);
            }
        });
    });

    var attendance = [];
    $.ajax({
        type: "post",
        url: "dashboardProcess.php",
        data: { "GET_TIMEINOUT": true },
        dataType: "json",
        success: function (response) {
            console.log(response);
            var inTime = "";
            var outTime = "";
            response.forEach(data => {
                console.log("fetch?");
                if (data.status == "Time out") {
                    outTime = moment(data.datetime);
                } else {
                    inTime = moment(data.datetime);
                }
                if (outTime == "") {
                    content = {
                        "inDate": inTime.format("MMM DD, YYYY (ddd)"),
                        "inTime": inTime.format("hh:mm A"),
                        "outDate": "",
                        "outTime": "",
                        "hours": "",
                        "minutes": ""
                    }
                    attendance.push(content)
                    inTime = "";
                    outTime = "";
                } else if (inTime != "") {
                    var duration = moment.duration(outTime.diff(inTime));
                    var hours = duration.hours();
                    var minutes = duration.minutes();
                    content = {
                        "inDate": inTime.format("MMM DD, YYYY (ddd)"),
                        "inTime": inTime.format("hh:mm A"),
                        "outDate": outTime.format("MMM DD, YYYY (ddd)"),
                        "outTime": outTime.format("hh:mm A"),
                        "hours": hours,
                        "minutes": minutes
                    }
                    attendance.push(content)
                    inTime = "";
                    outTime = "";
                }
            });
            createCalendarHeatmap(attendance);
            console.log(attendance);
            getHighest(attendance);
            getLowest(attendance);
            displayAttendance(response);
        }, error: function (response) {
            console.error(response);
            // window.location.href = 'index.php'; //pag walang naffetch na id or pg di naka log in

        }
        , complete: function() {
            $('#resultTable').DataTable({
                "order": [],
            });
            
        }
    });

});

function createCalendarHeatmap(attendance) {
    console.log(attendance);
    var heatmap = ``;
    for (let mon = 0; mon < 12; mon++) {
        const calendar = [];
        const perMonth = moment().month(mon);
        const startDay = perMonth.clone().startOf('month').startOf('week');
        const endDay = perMonth.clone().endOf('month').endOf('week');

        let date = startDay.clone().subtract(1, 'day');

        while (date.isBefore(endDay, 'day')) {
            calendar.push({
                days: Array(7).fill(0).map(() => date.add(1, 'day').clone())
            });
        }
        var daysHM = ``;
        calendar.forEach(week => {
            daysHM += "<tr>";
            week.days.forEach(day => {
                var formattedDate = day.format("MMM DD, YYYY (ddd)");
                if (day.format("MMM") == perMonth.format("MMM")) {
                    var bgColor = '';
                    var flag = true;
                    attendance.findIndex(function (entry, i) {
                        if (entry.inDate == formattedDate) {
                            // late
                            // early out
                            if (entry.hours == "") {
                                bgColor = "";
                            }
                            // under time
                            if (entry.hours <= 8) {
                                bgColor = "bg-info";
                            }
                            // over time
                            else if (entry.hours > 9) {
                                bgColor = "bg-success";
                            }
                            // normal
                            else if ((entry.hours == 8 && entry.minutes >= 30) || (entry.hours == 9)) {
                                bgColor = "bg-primary";
                            }
                            daysHM += `<td><div class="${bgColor} heatmap" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="${entry.inDate}<br>IN: ${entry.inTime}<br>OUT: ${entry.outTime}<br>Total: ${entry.hours}hr/s ${entry.minutes} min/s"></div></td>`;
                            flag = false;
                            return true;
                        }
                    });
                    if (flag) {
                        daysHM += `<td><div class="heatmap"></div></td>`;
                    }
                }
                else {
                    daysHM += `<td></td>`;
                }
            });
            daysHM += "</tr>";
        });
        heatmap = `<div class="col-auto">
                        <table>
                            <thead>
                                <tr>
                                    <th class="fw-normal text-secondary" style="font-size: 10px;" colspan="7">${perMonth.format("MMMM")}</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${daysHM}
                            </tbody>
                        </table>
                    </div>`;
        $("#calendarHeatmap").append(heatmap);
        $("[data-bs-toggle='tooltip']").tooltip();
    }
}

function getHighest(attendance) {
    console.log("checkhigh");
    var highest = attendance.reduce(function (prev, curr) {
        return ((prev.hours > curr.hours) || (prev.hours == curr.hours && prev.minutes > curr.minutes)) ? prev : curr;
    });
    $("#highHrs").html(highest.hours);
    $("#highMin").html(highest.minutes);
    $("#highDate").html(highest.inDate);
}

function getLowest(attendance) {
    console.log("checkLow");
    var lowest = attendance.reduce(function (prev, curr) {
        if (prev.hours == "") {
            return false;
        }
        return ((prev.hours < curr.hours) || (prev.hours == curr.hours && prev.minutes < curr.minutes)) ? prev : curr;
    });
    $("#lowHrs").html(lowest.hours);
    $("#lowMin").html(lowest.minutes);
    $("#lowDate").html(lowest.inDate);
}

function displayAttendance(response) {
    
    var content = ``;
    response.forEach(data => {
            content += `<tr>
            <td>${data.status}</td>
            <td>${moment(data.datetime).format('LLLL')}</td>
            </tr>`;
    });
    $("#attendance").html(content);
}