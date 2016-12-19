# Georgia Tech Service-Learn-Sustain(SLS) Database System.

## 1. Overall Description
In this project, we created a tool that stores projects and courses which are related to SLS (Service, Learn, Sustain).

The following sections contain a functional description of the system along with some mockup screens. Each section would explain a particular functionality and then present our UI about it. The sections have been grouped by customer’s functionalities and managers’ functionalities.

We implemented the project as a web application. The choice of language includes HTML/CSS, Javascript and PHP). You can access our website using the following url: http://54.90.100.7/GTSLS.

## 2. Log In

<figure><img src='http://7xs1zn.com1.z0.glb.clouddn.com/img/database/login.png'><figcaption>Fig 1: Log in</figcaption></figure>

Fig 1 shows the login screen. All users must login before using this application. There are two types of users: students and admin. To login, a valid username and password combination is required. If users provide invalid login credentials, an error message should be shown on the screen.

## 3. Student Functionalities
### 3.1 Main Page

<figure><img src='http://7xs1zn.com1.z0.glb.clouddn.com/img/database/mainpage.png'><figcaption>Figure 2: Main Page</figcaption></figure>

After logged in as students, students would be taken to this Main Page where they can browse and search projects and courses.

### 3.2 Edit Profile
 
<figure><img src='http://7xs1zn.com1.z0.glb.clouddn.com/img/database/editprofile.png'><figcaption>Figure 3: Edit Profile</figcaption></figure>

Students can change their major and year on this page. The system will update department based on the major. New student needs to complete this step before applying to join a project team. We assume one student can only have one major, and one major belongs to only one department.

### 3.3 My Application

<figure><img src='http://7xs1zn.com1.z0.glb.clouddn.com/img/database/myapplication.png'><figcaption>Figure 4: My Application</figcaption></figure>

On this page, students can view their applications. More information about applications will be discussed later.

### 3.4	Search/Filter

<figure><img src='http://7xs1zn.com1.z0.glb.clouddn.com/img/database/search.png' width="50%"><img src='http://7xs1zn.com1.z0.glb.clouddn.com/img/database/filter.png' width="50%"><figcaption>Figure 5: Search</figcaption></figure>

Students can use the search bar and filter tool on Main Page to find a course/project.

Title: search project name/ course name.

Category: choose one or multiple categories from a dropdown menu.

Designation: choose designation from dropdown.

Major: choose major from dropdown.

Year: choose year from dropdown.

Note: Students can leave any of these options blank.

Example:
Let’s say a CS junior is interested in “computing for good “and “doing good for your neighborhood”, and he wants to join a project team which designation is community. So he chooses CS, junior, community, computing for good and doing good for your neighborhood, clicks project radio button and applies filter.

### 3.5	View and Apply Project

<figure><img src='http://7xs1zn.com1.z0.glb.clouddn.com/img/database/project.png'><figcaption>Figure 6: View and Apply Project</figcaption></figure>

Students can click on a project on the Main Page to view its details. A project has its name, advisor information, description, designation, category, requirements and estimated number of students.

Note: Students cannot reapply if they got rejected.

Name: project name

Advisor information: name and email address

Description: A short paragraph that describes this project

Category: One or more categories chosen from: “computing for good”, “doing good for your neighborhood”, “reciprocal teaching and learning”, “urban development”, “adaptive learning”, “technology for social good”, “sustainable communities”, “crowd-sourced” and “collaborative action”

Designation: “Sustainable Communities” or “Community”

Requirements: major restriction, year restriction, department restriction

Note: You can assume requirements will always look like “xxx students only.” For instance: major restriction could be: CS students only; year restriction: Junior only; department restriction is “COC students only”.

If students are interested in this project, they can apply to join the project team by clicking on ‘Apply’ button. If students’ major/year/department cannot meet the requirements, an error message should be displayed.

An admin will review the application and make decisions.

### 3.6	View and Course
 
<figure><img src='http://7xs1zn.com1.z0.glb.clouddn.com/img/database/course.png'><figcaption>Figure 7: View Course</figcaption></figure>

Similar to view project, students can also click on a course on Main Page to view its details. However, they cannot apply to take the course.

Everything is the same as project, except:
    Course has a unique course number (For instance CS4400)
    Course has instructors rather than advisors.
    Course does not have description nor requirement.

## 4 Admin Functionalities
### 4.1	Main Page

<figure><img src='http://7xs1zn.com1.z0.glb.clouddn.com/img/database/mainpageadmin.png'><figcaption>Figure 8: Main Page (admin view)</figcaption></figure>

If users log in as admin, they will be taken to this window where they can choose to view applications, view popular project report or view application report.

### 4.2	View Applications

<figure><img src='http://7xs1zn.com1.z0.glb.clouddn.com/img/database/viewapplications.png'><figcaption>Figure 9: View Applications</figcaption></figure>
 
Admin can view all applications on this page. For each application, it should have project name, applicant’s major, applicant’s year and application status.

Status: pending, accepted, rejected

If status is pending, that means admin has not made a decision yet. To accept or reject an application, admin could click on the radio button besides the application, and then choose “accept” or “reject”.

### 4.3	View Popular Project Report
 
<figure><img src='http://7xs1zn.com1.z0.glb.clouddn.com/img/database/viewprojectreport.png'><figcaption>Figure 10: View Popular Project Report</figcaption></figure>

This report can show the top 10 projects with most applications.

### 4.4	View Application Report

<figure><img src='http://7xs1zn.com1.z0.glb.clouddn.com/img/database/viewapplicationreport.png'><figcaption>Figure 11: View Application Report</figcaption></figure>
 
This report can show projects sorted by acceptance rate. It also shows number of applications and the top 3 majors of applicants. On the very top of the report, it has the total number of applications and how many of them have been accepted.

### 4.5	Add a Project
 
<figure><img src='http://7xs1zn.com1.z0.glb.clouddn.com/img/database/addproject.png'><figcaption>Figure 12: Add a Project</figcaption></figure>

Admin can add projects to the database. All fields (except requirement) need to be filled.

### 4.6	Add a Course
 
<figure><img src='http://7xs1zn.com1.z0.glb.clouddn.com/img/database/addcourse.png'><figcaption>Figure 13: Add a Course</figcaption></figure>


Admin can add courses to the database. All fields need to be filled.





