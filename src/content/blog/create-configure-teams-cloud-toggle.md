---
title: "CLOUD TOGGLE | Adding and Configuring a New Team"
seoTitle: "CLOUD TOGGLE | Adding and Configuring a New Team"
description: "In this guide I walk you through creating and configuring a team in CLOUD TOGGLE. A Team is a grouping of users that can perform power on and power off function"
pubDate: 2025-10-10T15:51:11Z
updatedDate: 2025-10-10T15:51:11Z
image: "/wp-content/uploads/2025/10/1af42714-6f2f-4622-b977-e96e6e4b5f20.jpg"
tags: ["cloud-toggle","team-management"]
readingTime: "8 minutes"
wpId: 1762
---
![](/wp-content/uploads/2025/10/1af42714-6f2f-4622-b977-e96e6e4b5f20.jpg)

In this guide I walk you through creating and configuring a team in [CLOUD TOGGLE](https://www.cloudtoggle.com). A Team is a grouping of users that can perform power on and power off functions against virtual machines they have access to via the team. This article explains each step and setting so you can get your teams working quickly and securely.

## What is a Team and why use one

A Team in CLOUD TOGGLE is a way to group users and assign them access to specific virtual machines. [Teams](https://www.cloudtoggle.com/app/teams) make it simple to delegate operational control, for example allowing a development group to power development VMs while keeping production resources restricted. Using teams reduces administrative overhead and provides an auditable structure for who can perform power operations on which virtual machines.

Key benefits of using teams include:

-   **Granular access** – Assign users to only the servers they need.
-   **Simplified management** – Manage membership and server assignments at the team level rather than per user.
-   **Controlled operations** – Use schedule override and override limits to control when and how long users can change VM state.

![Cloud Toggle dashboard, teams option in left menu](/wp-content/uploads/2025/10/5993f19c-0071-47d9-b38c-6a321e650216.png)

## Quick overview of the process

Creating and configuring a team in CLOUD TOGGLE consists of these steps:

1.  Create the team and give it a name.
2.  Configure team settings including schedule override behaviour and override limits.
3.  Add team members and optionally mark team leaders.
4.  Assign virtual machines to the team.
5.  Save changes or delete the team when it is no longer required.

## Step by step: Create a new team

Follow these steps to create a new team.

1.  Log into CLOUD TOGGLE.
2.  From the left hand menu select **Teams**.
3.  Find the **Add new team** text box, enter a name and click **Add**.
4.  The new team will appear in the list below. Click the team name to open its configuration screen.

![Add new team text box and add button in Cloud Toggle](/wp-content/uploads/2025/10/66ef23fb-3398-4f69-a858-ac5e2dc1bd1b.png)

## Team settings explained

Once you click a team to edit it you will see several options you can configure. Below I describe each option and how you might use it.

### Edit name

You can change the team name at any time. Use a clear, descriptive name that reflects the purpose of the team such as “Dev – Frontend” or “QA – Automation”.

### Allow schedule override

The **Allow [schedule](https://www.cloudtoggle.com/app/schedules) override** option controls whether [team members](https://www.cloudtoggle.com/app/users) can change the power state of VMs even when a schedule is in place. By default this setting is off. Turn it on when you need team members to be able to power on or off a VM during a scheduled period. Leave it off for strict adherence to automation and cost controls.

### No override limit and schedule override limit

There are two related controls that manage how long an override can last:

-   **No override limit** – This control determines whether an override session has an enforced limit. If you enable limits you can prevent a user from leaving a VM powered on indefinitely while bypassing schedules.
-   **Schedule override limit** – When override limits are enabled set this to the number of hours a team member is allowed to override the VM state. This is useful to keep temporary changes short lived and predictable.

After adjusting these settings click **Update** to save the team configuration.

## Manage team members

Next you will add the users who should be members of the team.

1.  Click **Manage team members**.
2.  Click **Add user**. A list of all users on the account will be displayed.
3.  Toggle on each user that should be a member and then click **Add selected users**.
4.  If a user should be a team leader toggle on the **Team leader** control next to their name.

Team leaders typically have broader permissions or responsibility for the team. Use this sparingly to keep a clear chain of responsibility.

## Assign servers to the team

Granting access to [servers](https://www.cloudtoggle.com/app/servers) is done from the **Manage team servers** screen.

1.  Click **Manage team servers**.
2.  Open the drop down list of available servers and select the virtual machines you wish to add.
3.  Click **Add server** for each selection or add multiple at once if the interface allows.
4.  When you have added all required servers click **Update team details** to finish.

![Manage team servers dropdown and add server option](/wp-content/uploads/2025/10/d696bfa3-0cfe-4385-96b2-c845799e1d78.png)

Once servers are assigned, any team member with permission can perform power operations according to the schedule and override rules you set.

## Deleting a team

If a team is no longer required you can remove it cleanly:

1.  Open the team you want to delete.
2.  Click **Delete this team**.
3.  Confirm by selecting **Delete team**.

After deletion the team will be removed and its server assignments and member associations will no longer exist.

## Best practices and practical tips

Here are a few practical tips to help you make the most of teams in CLOUD TOGGLE.

-   **Use descriptive names** – Team names should be easy to scan so administrators immediately know the team purpose.
-   **Limit team leaders** – Assign the team leader role only when necessary to maintain accountability.
-   **Configure sensible override limits** – If you allow schedule overrides, set a conservative limit to avoid unexpected costs or resource misuse.
-   **Group servers by environment** – For example create separate teams for production, staging and development to minimise risk of accidental actions on production resources.
-   **Review memberships regularly** – Periodic audits of team members and assigned servers ensure access is current and appropriate.

## Common scenarios

Here are a few scenarios that illustrate how teams can be used effectively.

### Temporary maintenance

If a maintenance window requires a server to stay powered on outside its usual schedule, enable schedule override for the team responsible, and set a strict schedule override limit to ensure the VM returns to its normal schedule after maintenance.

### Development teams

Development teams often need to power VMs on and off frequently. Create a Dev team with broad server access and allow schedule override with a moderate override limit so developers can work without asking administrators for each temporary change.

### Production safeguards

For production servers keep schedule override off and restrict membership to a small set of trusted users. This reduces the chance of accidental downtime.

## FAQ

### What is the difference between Allow schedule override and schedule override limit?

**Allow schedule override** controls whether team members can change VM power state while a schedule is active. **Schedule override limit** is the maximum number of hours an override is allowed to last when override limits are enabled. Use them together to permit temporary changes while controlling their duration.

### Can I add users who are not yet on the account?

Only users that already exist on the CLOUD TOGGLE [account](https://www.cloudtoggle.com/my-account) are shown in the [Add user](https://www.cloudtoggle.com/app/users) list. You must create a user account first, then add them to a team.

### How do I make someone a team leader?

When managing team members toggle the **Team leader** option next to the user you want to promote. Team leaders should be chosen based on trust and responsibility.

### Will deleting a team affect the virtual machines themselves?

Deleting a team only removes the team record and its associations. It does not delete the virtual machines. However team members will lose their team-based access to those VMs.

### Can a user be on multiple teams?

Yes a user can be a member of multiple teams. When assigning servers and permissions plan for conflicts and ensure users have the appropriate level of access for each role they perform.

## Summary

Creating and configuring teams in CLOUD TOGGLE is a straightforward way to manage who can power on and off virtual machines and under what conditions. To recap the key steps:

1.  Create the team and give it a descriptive name.
2.  Set schedule override behaviour and override limits.
3.  Add members and assign team leaders as required.
4.  Assign virtual machines to the team and save changes.
5.  Delete teams that are no longer necessary to keep your account tidy.

If you follow the guidance above you will have an auditable, manageable approach to delegating VM power operations while keeping strict controls where needed.

![Confirmation message showing team setup complete in Cloud Toggle](/wp-content/uploads/2025/10/87941a2e-ffa6-456c-b472-5cf36137840f.png)

* * *

## Additional resources and templates

Because no external links were provided, here are practical templates and checklists you can copy directly into your CLOUD TOGGLE workflow to speed up team setup, reviews, and override governance.

### Team naming conventions

-   Format: Env – Purpose (e.g., Prod – Database, Dev – Frontend)
-   Use consistent abbreviations for environments: Prod, Stg, Dev, QA
-   Include an owner tag for cross-functional teams when helpful (e.g., Dev – API – TeamA)

### Schedule override policy template

Policy: Allow schedule overrides only for designated teams.
Override required approval: Yes (team leader or ops).
Maximum override duration: 4 hours (adjust per environment).
Notification: Post override start and end to the ops channel.
Audit: Log user, VM, start time, and end time for each override.

### Team review checklist

1.  Verify team name matches naming conventions.
2.  Confirm members are current employees and require access.
3.  Limit team leaders to those with explicit responsibilities.
4.  Review assigned servers to ensure no production resources are inappropriately assigned.
5.  Validate schedule override settings and limits are sensible for the environment.
6.  Archive or delete teams that are no longer needed.

### Quick operational tips

-   Use separate teams for production and non-production to reduce risk.
-   Set stricter override limits for production teams (or disable overrides entirely).
-   Automate periodic membership reviews using your identity provider where possible.

Paste or append these templates to the end of your existing team documentation so administrators have ready-to-use guidance when creating and auditing teams.

<table style="border-width: 0px; padding: 40px; color: #ffffff; background-color: #344ca3; width: 100%;"><tbody><tr><td style="border-width: 0px; text-align: center; justify-content: center; align-items: center;" width="100%"><h3 style="font-weight: bold; color: #ffffff; margin-top: 8px;">Want to Learn More?</h3></td></tr><tr><td style="border-width: 0px; text-align: center; justify-content: center; align-items: center;" width="100%"><p style="color: #ffffff;"></p></td></tr><tr><td style="border-width: 0px; text-align: center; justify-content: center; align-items: center;" width="100%"><a style="padding: 12px 24px; text-decoration: none; border-radius: 8px; background-color: #6ccff5; color: #ffffff;" href="https://calendly.com/cloudtoggle/30min" target="_blank" rel="noopener"><br>Book a Meeting<br></a></td></tr></tbody></table>
