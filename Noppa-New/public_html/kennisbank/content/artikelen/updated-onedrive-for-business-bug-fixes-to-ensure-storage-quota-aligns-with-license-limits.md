---
title: (Updated) OneDrive for Business: Bug fixes to ensure storage quota aligns with license limits
beschrijving: Updated June 3, 2026: We have updated the content and timeline. We are not proceeding with gov cloud...
datum: 6 juli 2026
categorie: Message Center
auteur: Rik Dobbelsteen
leestijd: 5 min
---

# (Updated) OneDrive for Business: Bug fixes to ensure storage quota aligns with license limits

- **Impact:** normal
- **Major Change:** Nee
- **Service(s):** SharePoint Online
- **Tags:** Updated message, User impact, Admin impact
- **Rollout-datum:** 26 mei 2026
- **Laatst gewijzigd:** 4 juni 2026
- **Gepubliceerd:** 14 mei 2026
- **ID:** MC1310684

## Inhoud

Updated June 3, 2026: We have updated the content and timeline. We are not proceeding with gov clouds at this time. We apologize for any inconvenience. [Introduction]We’re fixing issues in the way OneDrive for Business applies user storage quotas to ensure they are consistently aligned with license entitlements and current product behavior. This change fixes an issue where user-specific storage limits could be incorrectly applied during quota refreshes, which could result in inaccurate storage enforcement. These updates help ensure predictable storage behavior and improve reliability for admins managing storage at scale.  These fixes will be beneficial to admins, but there is a small percentage of users who will have their OneDrive for Business storage quota adjusted to match their license entitlement. [When this will happen]General Availability (Worldwide): We will begin rolling out early July 2026 (previously late May) and expect to complete in mid-July 2026 (previously June).[How this affects your organization]Who is affectedMicrosoft 365 tenants using OneDrive for BusinessUsers who are currently over the OneDrive for Business storage quota allowed by their assigned license or extended storage Admins who have set user-specific storage limits above licensed entitlements or extended storage What will happenUser storage quotas will be re-evaluated against license limits during the refresh process.Users whose OneDrive for Business storage usage exceeds their licensed quota will be placed into a read-only state per existing policy, which temporarily restricts write access to existing OneDrive content until storage usage is remediated.This includes scenarios where:An admin-set user quota exceeds the license allowance, orA user with an EDU license exceeds their licensed storage limit.No changes are made for users who are within their licensed storage limits.[What you can do to prepare]Identify users exceeding OneDrive for Business licensed storage limitsReview OneDrive storage usage across your organization to identify users whose usage exceeds their licensed quota.Use Identify OneDrive Users Over License-Based Storage Quota | PnP Samples Review this article: OneDrive site is read-only because storage quota was exceeded - SharePoint | Microsoft LearnTake corrective action for affected users. For users exceeding their licensed storage limits:Upgrade the user’s license to increase available storage, orWork with the user to reduce storage usage to within licensed limits.Inform your helpdesk and SharePoint admins about this change so they can support users who may be placed into a read-only state.If all users are within their licensed storage quotas, no action is required.[Compliance considerations]No compliance considerations identified. Review as appropriate for your organization.
