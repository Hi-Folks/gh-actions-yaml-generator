# Changelog

All notable changes to `Laravel Github Actions Workflow Generator` will be documented in this file

## 0.1.1 (Proof of Concept) - 2021-01-03

### Change
- MYSQL_ALLOW_EMPTY_PASSWORD for mysql container service
- use features/** for triggering actions on push event
- fix indent _jobs_ in yaml file

## 0.1.0 (Proof of Concept) - 2021-01-03

### Add
- initial release
- Collect some parameters about:
    - name of workflow;
    - "On" (events that trigger the workflow); 
    - setup mysql service container;
    - Caching vendors and packages;
    - select PHP versions;
    - select NodeJs version (for npm build);
    - some specific Laravel stuff (.env file, fix storage permissions).
- Generate Yaml file
