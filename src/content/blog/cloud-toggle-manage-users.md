---
title: "CLOUD TOGGLE | Creating and Managing New Users"
seoTitle: "CLOUD TOGGLE | Creating and Managing New Users"
description: "Managing access to your cloud environment is a core administrative task. In CLOUD TOGGLE you can invite new users, assign them to teams, control what they can d"
pubDate: 2025-10-24T11:43:37Z
updatedDate: 2025-10-24T11:43:37Z
image: "/wp-content/uploads/2025/10/5611c483-cb5c-444a-9759-b73bd814a4ec.jpg"
tags: ["permissions","user-management"]
readingTime: "9 minutes"
wpId: 1801
---
![](/wp-content/uploads/2025/10/5611c483-cb5c-444a-9759-b73bd814a4ec.jpg)

Managing access to your cloud environment is a core administrative task. In [CLOUD TOGGLE](https://www.cloudtoggle.com) you can invite new users, assign them to teams, control what they can do and when their invites expire. This guide walks you through creating and managing users step by step, explains permissions, and offers practical tips for common scenarios. Follow these instructions to keep your account organised and secure while enabling users to work with [virtual machines](https://www.cloudtoggle.com/app/servers) as needed.

## Outline

-   Inviting a new user
-   Understanding the invitation expiry
-   Selecting and managing team membership
-   Reviewing outstanding invitations and entitlements
-   Viewing and managing existing users
-   Permissions and administrative roles
-   Removing or deleting users
-   Best practices and tips
-   Frequently asked questions

## Inviting a new user

To add someone to CLOUD TOGGLE you must send them an invitation. Invitations are straightforward to create and give you control over who joins, the team they belong to and how long the invitation link remains valid.

Steps to invite a new user:

1.  Log into your CLOUD TOGGLE account.
2.  Open the drop-down menu and click Users.
3.  Select the Invite users button to open the invitation form.
4.  Enter the email address of the person you want to invite.
5.  Set the expiry date for the invitation link. The default is 7 days but you can change this to a shorter or longer window depending on your security needs.
6.  Select a team for the user if appropriate. If you do not wish to assign a team yet you can leave this blank and assign one later.
7.  Click Send invitation.

![Open the drop-down menu and select Users in CLOUD TOGGLE](/wp-content/uploads/2025/10/dc89d6e6-8ffa-4a22-9b3b-61d475e6e04f.png)

Inviting via email ensures that you control initial access and can require the user to confirm their identity before joining the account. If you prefer not to assign a team immediately, leave the team field blank. This flexibility is useful for external contractors or temporary accounts that might be assigned later.

## Understanding the invitation expiry

When sending an invitation you set an [expiry date](/contact/). This determines how long the invite link remains valid. The default expiry is 7 days. Use the expiry to reduce the risk of stale or forgotten invites that could otherwise be used later to gain access.

> “Set the expiry date based on when you would like the link to expire.”

Practical guidance on expiry duration:

-   Short lived access: 24 to 72 hours for contractors or one-off tasks.
-   Standard new user onboarding: 7 days to allow time for HR or onboarding processes.
-   Extended invitations: 14 to 30 days only if you have a specific reason and additional monitoring in place.

## Selecting and managing team membership

Teams in CLOUD TOGGLE help group users with similar responsibilities and apply permissions consistently. When inviting a user you can select a team immediately. If you do not assign a team at the time of invite the user will still be created once they accept but will not inherit any team permissions.

Key points about teams:

-   Team membership controls access to start and stop virtual machines and other actions as configured by administrators.
-   Changing a user’s team later will immediately alter their effective permissions, so plan team membership carefully.
-   Keep teams aligned to job function to reduce complexity when managing permissions.

![Outstanding invitation section showing number of invites and account entitlement](/wp-content/uploads/2025/10/f202b1cc-bc80-4984-9269-fcaab488856d.png)

## Reviewing outstanding invitations and entitlement

After sending invites the Users area will show [outstanding invitations](https://www.cloudtoggle.com/app/users) and how many slots are used versus your [account entitlement](/#pricing). This view helps you track pending invites and reclaim unused spots.

What you can do from the outstanding invitations area:

-   See the number of pending invites and total user entitlement.
-   Remove an invitation if you change your mind or if the invitee no longer needs access.
-   Resend or recreate invites when required, keeping an eye on expiry dates to avoid confusion.

## Viewing and managing existing users

The Users screen lists every account that has access to your CLOUD TOGGLE environment. This table is the central place for monitoring who has access and making basic administrative changes.

From the [Users table](https://www.cloudtoggle.com/app/users) you can:

-   View each user and their team membership.
-   See account status including active users and pending invites.
-   Access permissions controls via the drop-down menu under Permissions.

![User table showing all users on the system with their teams and status](/wp-content/uploads/2025/10/c845c29e-8647-4da7-beb3-212757c8d204.png)

When you need to update a user record you can do so directly from this table. Administrators can change team assignments, grant or remove permissions and delete users as needed.

## Permissions and administrative roles

[Permissions](/#features) in CLOUD TOGGLE are primarily managed by [team membership](https://www.cloudtoggle.com/app/teams) and by administrative role. Understanding the distinction is crucial for safe delegation.

Two main roles govern access:

-   **User** roles: These allow starting and stopping virtual machines according to the rights assigned to their team. Grant users only the permissions they need to complete their role.
-   **Administrator** roles: Administrators can make system level changes. This includes creating, deleting, and adding and removing users to and from teams. Administrators should be limited to trusted personnel because they can change permissions account wide.

When assigning roles remember the principle of least privilege. Give users the minimum permissions they need and only promote to administrator when necessary. Regularly review administrator accounts and remove administrative rights from users who no longer require them.

## Removing or deleting users

When an account is no longer required you can remove the user from the system. Deletion is a straightforward process to revoke access quickly.

How to delete a user:

1.  Open the Users section from the drop-down menu.
2.  Find the user you want to remove in the table.
3.  Click the Remove button on their account row.
4.  Confirm the removal if prompted. The user will lose access immediately.

![Permissions drop-down menu and remove button to delete a user](/wp-content/uploads/2025/10/9f68aea7-0075-4f9b-bd75-07102f5d6f4d.png)

Before deleting a user consider these checks:

-   Reassign any resources or running VMs they own or are responsible for.
-   Check audit logs if you need to retain a record of their activity for compliance.
-   Consider disabling or suspending accounts first in case you need to reinstate access quickly.

## Tips and best practices

Managing users effectively requires a consistent process. Here are practical tips to make administration easier and more secure.

-   Standardise team definitions – ensure each team has a documented set of permissions so you can onboard and offboard consistently.
-   Use short expiry invites for contractors and external users to reduce exposure.
-   Limit the number of administrators and review that list regularly.
-   Track outstanding invitations and remove expired or unused invites to reclaim entitlements.
-   Create an onboarding checklist that includes team assignment and initial permissions review to avoid granting excessive access by default.
-   Keep an audit trail by recording why a user was added or removed and who authorised the change.

## Troubleshooting common issues

If an invited user does not receive their email:

-   Ask them to check their spam and junk folders.
-   Confirm the email address was entered correctly and resend the invite if necessary.
-   Consider increasing the invite expiry if they need more time to accept.

If a user cannot perform an expected action:

-   Verify their team membership and the permissions assigned to that team.
-   Ensure they are not missing a required role such as administrator if their task requires it.
-   Check for account status issues such as pending invitation or suspended account.

## Summary

CLOUD TOGGLE provides a clear, simple interface for creating and managing users. Invitations let you control initial access with expiry dates, team membership governs what users can do, and administrators handle higher level account management. Use the Users table to monitor who has access and take action when needed. Follow best practices like least privilege, short invitation lifetimes for temporary users and regular review of administrator accounts to keep your environment secure and manageable.

## Frequently asked questions

### How do I invite someone to CLOUD TOGGLE?

Open the drop-down menu, click Users and select [Invite users](https://www.cloudtoggle.com/app/users). Enter the email address, set the expiry date, optionally choose a team, and click Send invitation. The invitee will receive an email with a link to join.

### What does the invitation expiry mean?

The expiry determines how long the invitation link is valid. The default is 7 days. After expiry the link will no longer work and you will need to send a new invitation if the user still needs access.

### Can I assign a team later?

Yes. Team selection during invitation is optional. You can leave it blank and assign the user to a team after they have accepted the invitation. Team membership controls permissions, so assign teams as soon as possible to avoid granting excessive access.

### How do I remove a user?

Go to the Users section, locate the user in the table and click the Remove button for their account. Confirm the removal and the user will immediately lose access.

### Who can change user permissions?

Administrators can make administrative changes including creating, deleting, and adding and removing users to and from teams. Regular users only have rights granted via their team membership, such as [starting and stopping](/blog-en/azure-start-stop-alternative/) VMs if permitted.

* * *

## Quick onboarding checklist

Use this short checklist to standardise new user onboarding and reduce the chance of granting excessive access:

-   Verify identity and confirm the email address before sending an invite.
-   Decide team membership and initial permissions on day 1.
-   Set an appropriate invite expiry (24–72 hours for contractors, 7 days for standard onboarding).
-   Reassign any resources or running VMs before removing a user.
-   Record who authorised the account creation and the reason for access in your audit log.

## Additional administration tips

-   Keep the administrator list small and review it quarterly.
-   Use short-lived invites for external or temporary access and remove expired invites promptly.
-   Consider suspending accounts first if you may need to reinstate access quickly.

**Note:** No external links were provided with the request, so no inline links have been inserted into the article. If you supply a list of URLs, I can suggest exact 1–3 word anchor locations within the existing paragraphs or append additional content that includes those links.

<table style="border-width: 0px; padding: 40px; color: #ffffff; background-color: #344ca3; width: 100%;"><tbody><tr><td style="border-width: 0px; text-align: center; justify-content: center; align-items: center;" width="100%"><h3 style="font-weight: bold; color: #ffffff; margin-top: 8px;">Want to Learn More?</h3></td></tr><tr><td style="border-width: 0px; text-align: center; justify-content: center; align-items: center;" width="100%"><p style="color: #ffffff;"></p></td></tr><tr><td style="border-width: 0px; text-align: center; justify-content: center; align-items: center;" width="100%"><a style="padding: 12px 24px; text-decoration: none; border-radius: 8px; background-color: #6ccff5; color: #ffffff;" href="https://calendly.com/cloudtoggle/30min" target="_blank" rel="noopener">Book a Meeting</a></td></tr></tbody></table>
