<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Booking</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .tabs {
            display: flex;
            cursor: pointer;
            margin-bottom: 20px;
        }

        .time-slot.disabled {
            color: gray;
            pointer-events: none;
            text-decoration: line-through;
        }

        .tab {
            padding: 10px 20px;
            background: #ddd;
            margin-right: 5px;
            border-radius: 5px;
        }

        .tab.active {
            background: #89cddf;
            color: white;
        }

        .tab-content {
            display: none;
            padding: 20px;
            border: 1px solid #ccc;
            margin-top: 10px;
        }

        .tab-content.active {
            display: block;
        }

        .service-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .service-box {
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #f9f9f9;
            width: 200px;
            text-align: center;
            cursor: pointer;
            transition: 0.3s;
        }

        .service-box:hover,
        .service-box.selected {
            background: #89cddf;
            color: white;
        }

        .book-btn,
        .confirm-btn {
            margin-top: 20px;
            padding: 10px 15px;
            background: #89cddf;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: none;
        }

        .time-slot {
            padding: 8px 12px;
            margin: 5px;
            display: inline-block;
            background: #28a745;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .time-slot.booked {
            background: #dc3545;
            cursor: not-allowed;
        }

        .form-group {
            margin-bottom: 10px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            height: 46px;
            border-radius: 5px;
            border: 1px solid #eeeeee;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .loaderparent {
            width: 100%;
            height: 100%;
            background-color: #00000070;
            position: absolute;
            top: 0;
            left: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            display: none
        }

        .loader {
            width: 50px;
            aspect-ratio: 1;
            border-radius: 50%;
            border: 8px solid;
            border-color: #fff #0000;
            animation: l1 1s infinite;
        }

        @keyframes l1 {
            to {
                transform: rotate(.5turn)
            }
        }
    </style>
</head>

<body>

    <div class="loaderparent">
        <div class="loader"></div>
    </div>



    <div class="tabs">
        <div class="tab active" data-target="serviceTab">Service</div>
        <div class="tab" data-target="laserTab">Laser Service</div>
        <div class="tab" data-target="bookTab">Book Now</div>
    </div>

    <div class="tab-content active" id="serviceTab">
        <h2>Select a Service</h2>
        <div class="service-container">
            @foreach ($services as $service)
                <div class="service-box" data-id="{{ $service->id }}" data-name="{{ $service->name }}"
                    onclick="selectService(this, false)">
                    {{ $service->name }} -
                    {{ $service->price }}
                </div>
            @endforeach
        </div>
        <button class="book-btn" id="bookServiceBtn" onclick="bookService(false)">Book Now</button>
    </div>

    <div class="tab-content" id="laserTab">
        <h2>Select a Laser Service</h2>
        <div class="service-container">
            @foreach ($laserHairRemovalOptions as $laserService)
                <div class="service-box" data-id="{{ $laserService->id }}" data-name="{{ $laserService->name }}"
                    onclick="selectService(this, true)">
                    {{ $laserService->name }} -
                    {{ $laserService->price }}
                </div>
            @endforeach
        </div>
        <button class="book-btn" id="bookLaserBtn" onclick="bookService(true)">Book Now</button>
    </div>

    <div class="tab-content" id="bookTab">
        <h2>Selected Service:</h2>
        <p id="selectedServiceText">No service selected</p>
        <h2>Enter Details</h2>
        <div class="form-group">
            <label for="userName">Name:</label>
            <input type="text" id="userName" placeholder="Enter your name">
        </div>
        <div class="form-group">
            <label for="userEmail">Email:</label>
            <input type="email" id="userEmail" placeholder="Enter your email">
        </div>
        <div class="form-group">
            <label for="userLocation">Location:</label>
            <input type="text" id="userLocation" placeholder="Enter your location">
        </div>
        <div class="form-group">
            <label for="appointmentDate">Select Date:</label>
            <input type="date" id="appointmentDate" onchange="loadTimeSlots()">
        </div>
        <h2>Available Time Slots</h2>
        <div id="timeSlots"></div>
        <button class="confirm-btn" id="confirmAppointmentBtn" onclick="confirmAppointment()">Confirm
            Appointment</button>
    </div>

    <script>
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(tc => tc.classList.remove('active'));
                this.classList.add('active');
                document.getElementById(this.dataset.target).classList.add('active');
            });
        });

        let selectedServiceName = null,
            selectedTime = null,
            isLaserService = false;

        function selectService(element, laser) {
            document.querySelectorAll(".service-box").forEach(box => box.classList.remove("selected"));
            element.classList.add("selected");
            selectedService = element.dataset.id;
            selectedServiceName = element.dataset.name;
            isLaserService = laser;
            document.getElementById(laser ? "bookLaserBtn" : "bookServiceBtn").style.display = "block";
        }

        function bookService(laser) {
            document.getElementById("selectedServiceText").innerText = "Selected: " + selectedServiceName;
            switchTab("bookTab");
        }

        function switchTab(target) {
            document.querySelector(`[data-target="${target}"]`).click();
        }

        function confirmAppointment() {
            let name = document.getElementById("userName").value.trim();
            let email = document.getElementById("userEmail").value.trim();
            let location = document.getElementById("userLocation").value.trim();
            let date = document.getElementById("appointmentDate").value;
            let token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
            let loader = document.querySelector('.loaderparent');

            if (!name || !email || !location || !date || !selectedTime || !selectedServiceName) {
                alert("Please fill in all fields and select a time slot.");
                return;
            }

            loader.style.display = "flex";

            fetch("{{ route('appointmentStore') }}", {
                    method: "POST",
                    headers: {
                        'Accept': 'application/json',
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": token
                    },
                    body: JSON.stringify({
                        name,
                        email,
                        date,
                        location,
                        service: selectedServiceName,
                        is_laser_service: isLaserService,
                        time: selectedTime
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        loader.style.display = "none";
                        alert(data.message || "Appointment confirmed successfully!");
                        document.getElementById('userName').value = '';
                        document.getElementById('userEmail').value = '';
                        document.getElementById('appointmentDate').value = '';
                        document.getElementById('userLocation').value = '';

                        // **Redirect to dashboard**
                        window.location.href = "/";
                    } else {
                        alert("Failed to book appointment: " + (data.message || "Unknown error"));
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("An error occurred while booking the appointment. Please try again.");
                });
        }



        const bookedAppointments = @json($bookedAppointments);

        function loadTimeSlots() {
            let dateInput = document.getElementById("appointmentDate");
            let timeSlotsDiv = document.getElementById("timeSlots");
            timeSlotsDiv.innerHTML = "";

            let availableTimes = ["09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00"];
            let selectedDate = new Date(dateInput.value);
            let today = new Date();
            let currentTime = today.getHours().toString().padStart(2, "0") + ":" + today.getMinutes().toString().padStart(2,
                "0");

            availableTimes.forEach(time => {
                let slot = document.createElement("span");
                slot.innerText = time;

                let isPastTime = selectedDate.toDateString() === today.toDateString() && time < currentTime;

                if (isPastTime) {
                    slot.className = "time-slot disabled";
                    slot.style.color = "gray";
                    slot.style.pointerEvents = "none";
                } else {
                    // **Check appointment availability via AJAX**
                    fetch("{{ route('checkAppointment') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                date: dateInput.value,
                                time: time
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (!data.available) {
                                slot.className = "time-slot disabled";
                                slot.style.color = "gray";
                                slot.style.pointerEvents = "none";
                            } else {
                                slot.className = "time-slot";
                                slot.onclick = () => {
                                    selectedTime = time;
                                    document.getElementById("confirmAppointmentBtn").style.display =
                                        "block";
                                };
                            }
                        })
                        .catch(error => console.error("Error checking appointment:", error));
                }

                timeSlotsDiv.appendChild(slot);
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            let dateInput = document.getElementById("appointmentDate");

            if (dateInput) {
                let today = new Date();
                let formattedDate = today.toISOString().split("T")[0]; // Get YYYY-MM-DD format
                dateInput.min = formattedDate;
            }
        });
    </script>
</body>

</html>
