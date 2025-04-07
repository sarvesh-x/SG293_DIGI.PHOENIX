# SG293_DIGI.PHOENIX

RHCMS is a smart, multi-platform solution built to digitize and streamline institutional workflows. Designed as part of a Smart India Hackathon initiative, it includes a web-based admin panel and a companion Android client that work together to manage users, records, and institutional operations efficiently.

## 🚀 Features

- 🧑‍💼 Role-based Web Admin Panel
- 📑 Digital Document & Staff Management
- 📍 Android App with Geo-fencing Services
- 🔐 Secure PHP API Communication
- 📊 Dashboard and Reports
- 🌐 Web and Mobile Interfaces

## 📲 Android Client

- Built for institutional staff and students
- Includes real-time **Geo-fencing** for location-based task verification
- Communicates with the server using **custom PHP APIs**
- Features include attendance tracking, task status updates, and alerts

## 🧩 Tech Stack

**Web App:**
- Frontend: HTML, CSS, JavaScript
- Backend: PHP
- Database: MySQL

**Mobile App:**
- Platform: Android (Java/Kotlin)
- Services: Google Location API, Geo-fencing
- Communication: PHP-based REST APIs

**Other:**
- Java (Gradle) Components
- Bootstrap, CoffeeScript

##

```bash
SG293_DIGI.PHOENIX/
├── sih/                    # Web-based admin panel
│   └── admin/
├── android-client/         # Android app source code (if included)
├── apis/                   # PHP backend APIs
├── database/               # SQL dump
├── gradle/                 # Java backend files
└── presentation/           # Pitch and documentation
```

##
🛠️ Setup Instructions
  Web Panel & Backend
  Clone the repo:

`git clone https://github.com/sarvesh-x/SG293_DIGI.PHOENIX.git`

- Host sih/admin on a local server (e.g., XAMPP/WAMP).
- Import the database SQL dump into MySQL.
- Update DB credentials in the config file.

Android Client
Open the Android project in Android Studio.

Update API base URLs in the app as needed.

Build and run on a device (location permissions required).

💡 Use Cases
Staff attendance via geo-fencing

Document digitization and approval workflows

Role-based access to admin tools

Real-time location-aware task updates

👥 Contributors
Sarvesh-x

SIH Team SG293

📄 License
This project was developed for the Smart India Hackathon. License to be determined.
