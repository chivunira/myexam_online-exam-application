<h1 style="text-align: center;">
    myExam
</h1>

<h2 style="text-align: center;">
    A web-based exam application system that automates the process of application for special exams, retake exams and exam re-marks.
</h2>

The web based exam application system aims at reducing the time taken to apply for these services and make access to relevant information based on the services such as the remark feedback and the exam schedules for the exams applied for.

## Key Features

### 1. Authentication:

- Students and Lecturers can login with the credentials stored in the database.
- Registration is facilitated through email verification and password creation
- Roles are assigned on registration based on the email the user used, and are assigned as: student or lecturer.

### 2. Student Functionalities:

- Students can log in and access their dashboard
- **Exam Application Module**:
    - Students select an exam period they want to register in and select the unit exam they wish to register for.
    - Students also have the option to apply for exam remarks.
- **Payment Module**:
    - After applying for retakes and re-marks, the system directs the student to the payment module where the student receives an stk push, to input their password and complete the payment.

### 3. Admin Functionalities:

-  Admin can log in and access their dashboard
- **Exam Period Creation**:
    - The admin creates, views and can edit the exam periods
- **Unit Exan Creation**:
    - The admin creates, views and can edit the unit exams and places them into exam periods.
- **Request Handling**:
    - The admin receives requests from the students and reviews them.
    - They provide feedback for special exam requests.
    - They foward re-mark requests to the lecturers.
    - They view payments made for the different requests.

### 4. Lecturer Functionalities:

- Lecturer can log in and access their dashboard
- **Exam Remark Module**:
    - After students apply for exam remarks, the admin reviews the remark request and assigns it to the lecturer.
    - Lecturer can access remark requests based on the unit they teach.

## 4. Installation Guide and Dependencies

### 4.1 - Guide

1. Clone the repository via GitHub desktop
    - Go to https://github.com/chivunira/myexam_online-exam-application and clone the repository
      <br><br>
2. Open the project from the location where you cloned it in your terminal
   <br><br>
3. Once inside the root structure within your terminal, execute the following commands separately:
   ```shell
        composer install
      ```
   ```shell
        composer update
   ```
   ```shell
        composer require laravel/socialite
   ```
   ```shell
        npm install
   ```
   ```shell
        copy .env.example .env
   ```
   ```shell
        php artisan key:generate
   ```
   ```shell
        php artisan migrate
   ```
   ```shell
        php artisan serve
   ```

### 4.2 - Dependencies

The following libraries are needed in the development of this project:

- [Composer](https://getcomposer.org/): A tool for dependency management in PHP
- [Laravel](https://laravel.com/): A web application framework with expressive, elegant syntax
- [Xampp](https://www.apachefriends.org/download.html): Database connection tool
- [GitHub Desktop](https://desktop.github.com/): An open-source GitHub app
- [Node](https://nodejs.org/en): 
