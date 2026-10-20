---
title: Microsoft 365: Targeted Release retirement
beschrijving: Targeted release for Microsoft 365 services will be retiring in January 2027
datum: 19 oktober 2026
categorie: Message Center
auteur: Rik Dobbelsteen
leestijd: 5 min
---

# Microsoft 365: Targeted Release retirement

- **Impact:** normal
- **Major Change:** Nee
- **Service(s):** Exchange Online, Microsoft 365 suite, SharePoint Online, Microsoft OneDrive, Microsoft Teams
- **Tags:** Admin impact, Retirement
- **Rollout-datum:** 31 oktober 2026
- **Laatst gewijzigd:** 8 oktober 2026
- **Gepubliceerd:** 8 oktober 2026
- **ID:** MC1490899

## Inhoud

###What and Why:

Targeted release for Microsoft 365 services will be retiring **in January 2027** as Microsoft 365 transitions to three release options: Frontier, Standard release, and Deferred release.

To prepare for this change, review users currently enrolled in Targeted release and configure the release preference that best meets your organization's needs.

**Choose your preferred release preference in the Microsoft 365 admin center:**

-   **Preview access**
    -   Frontier: Opt in to preview eligible AI and non-AI features before general availability.
-   **General availability access**
    -   Standard release: Receive updates at general availability.
    -   Deferred release: Receive eligible major updates approximately 30 days after Standard release begins, allowing additional time for validation and readiness activities.

**In November 2026**, administrators will no longer be able to add users to, remove users from, or modify Targeted release enrollments. Additional information about the related admin experience changes will be shared in a future Message center post.

###Rollout Schedule:

-   Now: Review current release preferences and enroll users in Frontier, Standard release, or Deferred release if needed.
-   November 2026: Targeted release enrollment changes are disabled.
-   November 2026: Unified release preferences experience becomes available. Update your release preferences (Frontier, Standard release, Deferred release) in the unified release preferences experience.
-   January 2027: Targeted release retires. Targeted release assignments are no longer used for Microsoft 365 feature delivery.

###Impact on Your Organization:

**Who is affected:**

-   Organizations with users or tenants enrolled in Microsoft 365 Targeted release.
-   Administrators who manage Microsoft 365 release preferences.

**Platforms/Services:**

-   Microsoft 365 admin center
-   Microsoft Teams
-   Outlook (New)
-   Outlook on the web
-   Office for the Web
-   Microsoft OneDrive
-   SharePoint Online
-   Some components of Exchange Online

**What will happen:**

-   In November 2026, administrators can no longer add, remove, or modify Targeted release assignments. 
-   In November 2026, administrators can configure Frontier, Standard release, and Deferred release preferences from a single unified release preferences experience in the Microsoft 365 admin center.
-   Users currently assigned to Targeted release will continue receiving eligible Microsoft 365 features through existing Targeted release assignments until Targeted release is retired.
-   Targeted Release retires in January 2027, and Targeted release will no longer used for Microsoft 365 feature delivery.
-   After retirement, feature rollout timing follows your configured Frontier, Standard release, or Deferred release preference.

###Action Required/Recommendations:

Before November 2026, administrators should complete the following actions:

-   Identify and update users currently assigned to Targeted release before enrollment changes are disabled. In the Microsoft 365 admin center, go to Settings > Org settings > Organization profile > Release preferences.
-   Evaluate and select the appropriate Standard release or Deferred release preference for your organization under Copilot > Settings > View all > Copilot Release preferences: General availability.
-   Evaluate Frontier and, where appropriate, enroll eligible users who require early access to preview experiences under Copilot > Settings > View all > Copilot Frontier.
-   Review the Learn documentation on Targeted release retirement for detailed transition guidance.
-   Notify change management teams, support teams, security and compliance teams, pilot groups, and key IT stakeholders about the upcoming retirement and required transition actions.

In November 2026, release preferences for Frontier, Standard release, and Deferred release can be managed through the unified release preferences experience in the Microsoft 365 admin center. Also, the current experience for managing Standard release and Deferred release preferences will be retired when the unified release preferences experience becomes available. Additional details about related admin experience changes will be shared in a future Message center post.

###Additional Resources:

-   [Configure new Standard and Deferred release options for Microsoft 365](https://learn.microsoft.com/microsoft-365/admin/manage/configure-release-options)
-   [Plan for the Retirement of Targeted Release in Microsoft 365](https://learn.microsoft.com/microsoft-365/admin/manage/targeted-release-retirement)

###Compliance considerations:

-   Does the change include an admin control, and can it be controlled through Entra ID group membership? Administrators will manage release preferences through the Microsoft 365 admin center and should evaluate user/group assignment needs for Frontier, Standard release, and Deferred release.
-   Does the change alter how admins can monitor, report on, or demonstrate compliance activities? Organizations should update internal release-management and readiness processes because Targeted release assignments will no longer be used after retirement.
