---
title: "AWS Unexpected Charges: What Happens and How to Avoid It"
seoTitle: "AWS Unexpected Charges: What Happens and How to Avoid It"
description: "AWS Unexpected Charges: What Happens and How to Avoid It There are several cautionary tales of “bill shock” involving Amazon Web Services (AWS), where users unk"
pubDate: 2024-10-16T10:39:59Z
updatedDate: 2024-10-18T16:13:19Z
image: "/wp-content/uploads/2024/02/christina-wocintechchat-com-9kJ2H8wvVa4-unsplash-scaled.jpg"
tags: []
readingTime: "8 minutes"
wpId: 618
---
# AWS Unexpected Charges: What Happens and How to Avoid It

There are several cautionary tales of “bill shock” involving Amazon Web Services (AWS), where users unknowingly rack up enormous costs after leaving services running for extended periods. One of the most well-known cases occurred with **Quincy Larson**, founder of **freeCodeCamp**, a non-profit organization that offers free coding education.

### **Quincy Larson’s AWS Bill Shock Story:**

In early 2016, Quincy Larson experienced a significant AWS bill shock. He had created a personal AWS account for experimenting with hosting services and running small applications. However, he accidentally left a cluster of Elastic Compute Cloud (EC2) instances running for several months.

Here’s what happened:

-   Larson had spun up EC2 instances (virtual servers) for a project, but he forgot to turn them off when he no longer needed them.
-   These EC2 instances were running continuously, silently accumulating costs for every hour of operation.
-   After several months, he received a bill for **$7,000**, which was shocking considering the size and non-profit nature of his organization.

## Common Types of AWS Unexpected Charges

### AWS Free Tier Charges

AWS’s **Free Tier** offers limited usage for certain services, but exceeding these limits can lead to unexpected charges. Many users mistakenly assume the Free Tier offers unlimited access or forget it only lasts for 12 months. After that, regular charges apply, often catching users off guard when they continue using services beyond the free period.

### Unused Resources Fees

AWS charges for **unused resources** that aren’t fully decommissioned, like unattached **Elastic IPs** or idle **EBS volumes**. Users may forget to delete these after stopping instances, causing unexpected fees to accumulate even though the resources aren’t actively used.

### Instances Turning Themselves On

Services like **RDS** or **EC2** can restart automatically during updates or maintenance, sometimes staying on after the process completes. Users who think they’ve stopped these instances may later discover they’re running and racking up charges, unaware of the automatic restarts.

### Stopped EC2 Instances

Stopping an **EC2 instance** halts computing charges, but related resources like **EBS volumes** or **Elastic IPs** continue to incur costs. Many users mistakenly believe stopping an instance eliminates all fees, when in fact, they must terminate or release associated resources to fully avoid charges

### Data Requests

AWS charges for **data transfers** and **requests** to services like **S3** or **CloudFront**. While storage is cheap, frequent data retrieval or inter-region transfers can lead to hefty charges. Users often underestimate how much data is being accessed or the cost of outbound traffic, leading to unexpected bills.

## How to Avoid Surprise Bills from AWS

### CLOUD TOGGLE

![](/wp-content/uploads/2024/03/cloud_toggle_512_nomask-300x300.png)

**CLOUD TOGGLE** helps prevent unexpected AWS charges by automating the scheduling cloud resources. Many cloud users leave resources like **EC2 instances or RDS databases** running when they’re not in use, which leads to unnecessary costs. **CLOUD TOGGLE** addresses this issue by allowing users to automatically **schedule off times** for these services, ensuring they are only running during necessary hours (e.g., business hours) and shutting them down when idle.

With reference specifically to the issue of RDS Databases turning themselves on (to apply updates etc) and not turning themselves off again: 

In AWS you can only stop an RDS Database instance for up to 7 days at a time and then after 7 days, it will be automatically started. CLOUD TOGGLE allows you to create a simple schedule that will automatically turn the RDS database ON for a couple of hours and then turn it OFF again allowing for these updates to happen (if required). 

This means that you will be charged for the couple of hours the Database will be on per week (likely under $1 – dependent on what DB instance type you are using) but it ensures that you will not experience the Bill Shock associated with these resources turning themselves on without your knowledge thereby clocking up a much higher bill until the point that you realize. 

**CLOUD TOGGLE** is the more simple and cost effective choice for scheduling your resources in AWS for the following reasons:

#### Simple Wizard based Setup:

CLOUD TOGGLE has a user friendly UI that allows you to link AWS or Azure accounts within a few minutes and then easily configure schedules with a few clicks. AWS Instance Scheduler requires manual configuration through Lambda, CloudWatch, and tagging and long and complicated tutorials need to be followed to set it up

![](/wp-content/uploads/2024/02/mceclip0-760x428.png)

#### Multi-Cloud Support:

CLOUD TOGGLE supports multi-cloud environments, offering broader control across different platforms. AWS Instance Scheduler is limited to AWS environments 

#### ![](/wp-content/uploads/2024/06/Amazon_Web_Services_Logo-1.png)     ![](/wp-content/uploads/2024/06/Microsoft_Azure_Logo-300x87.png)

#### More Granular Control:

CLOUD TOGGLE  provides more granular control over scheduling and allows you to Assign specific roles and permissions to users for granular control over resource management. AWS Instance Scheduler’s functionality is somewhat limited to basic start/stop actions

![](/wp-content/uploads/2024/05/cloudtoggle-server-management-450x480-1-450x428.png)

#### Flexible Schedules

CLOUD TOGGLE allows you to multiple servers to a single schedule and define your schedules in units of time as low as 15 mins. CLOUD TOGGLE also allows you to define “Always Off” schedules with custom override limits that can be applied on a per team basis. For example if you only want your dev team to turn servers on for a an hour at a time. You can also define a regular schedule that turns machines on for a small amount of time each week. This is great with AWS as it allows you to turn RDS Databases on and off to get updates rather than AWS forcing the DB to be on indefinitely.  

![](/wp-content/uploads/2024/05/cloudtoggle-scheduler-843x900-1-760x428.png)

#### Reporting and Alerts:

CLOUD TOGGLE offers detailed reports and real-time notifications about the resources you have scheduled to start or stop and choose which team members received these and via what means e.g. e-mail, Teams etc whereas AWS Instance Scheduler lacks robust reporting and alerting capabilities

#### Simple & Clear Pricing Structure

CLOUD TOGGLE’s pricing is dictated by the number of resources you have and number of team members you want to administer those resources. There is no per action charge so the billing is predictable and scalable.  

![](/wp-content/uploads/2024/02/ct_pricing-1-760x428.png)

To sign up for a **FREE** Trial go to [https://www.cloudtoggle.com](/) 

### AWS Instance Scheduler

**AWS Scheduler** (AWS Instance Scheduler) helps users control cloud costs by automatically starting and stopping **EC2 instances**, **RDS databases**, and other resources based on predefined schedules. The scheduler allows you to define time-based rules to run these resources only when needed, avoiding unnecessary charges.

Key features include:

-   **Customizable Schedules**: Users can create schedules that fit their usage patterns, such as running instances during business hours and stopping them after.
-   **Tag-Based Management**: Resources are managed through tags, allowing you to apply schedules to specific instances or groups of instances.
-   **Cost Savings**: By automating start/stop actions, the scheduler prevents instances from running when they’re not required, helping reduce AWS bills.
-   **Flexible Timing**: You can set different schedules for weekdays, weekends, or other custom time intervals to suit varying workloads.

AWS Scheduler simplifies resource management by automating the on/off cycles, ensuring resources only run when needed, helping prevent unnecessary costs.

If you’d like to read more on AWS Instance Scheduler and how it compares to **CLOUD TOGGLE** go [here](/blog-en/aws-instance-scheduler/)

### CloudWatch

#### Amazon CloudWatch 

Helps prevent AWS bill shock by providing real-time monitoring and alerts on resource usage and costs. Here’s how it works:

#### Custom Alarms: 

Users can set billing alarms to notify them when costs approach a specified limit, allowing them to take action before the bill increases significantly.

#### Usage Monitoring: 

CloudWatch tracks metrics for various AWS resources, helping identify inefficient usage patterns that could lead to high costs.

#### Automated Actions: 

It integrates with **AWS Lambda** or **Auto Scaling** to automatically shut down idle resources or adjust scaling based on usage metrics, preventing unnecessary charges.

#### Cost and Usage Metrics: 

Through dashboards, users can monitor real-time usage data, enabling informed decisions on resource management.

Overall, CloudWatch equips users with the tools to monitor and manage their AWS costs effectively, helping to avoid unexpected charges, however it is something that has to be set up by an AWS admin user and requires a degree of technical knowledge to do so.

### Be Paranoid

If you don’t want to use any of the above and/or don’t have the ability to micro-manage your AWS account then:

#### Regularly Monitor Your AWS Usage

Stay vigilant by frequently checking your AWS dashboard. It’s easy to overlook the services you have running.

#### Set Up Billing Alerts

AWS enables you to configure billing alerts that notify you when your usage exceeds a specified limit.

## Avoid Bill Shock!
