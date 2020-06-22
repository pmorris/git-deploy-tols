# git-deploy-tols

This will allow automatic deployment of a repositiory using VCS webhooks and a server-side shell script


## VCS Webhooks

Currently, only Bitbucket webhooks are supported. 

### Configuring webhooks in Bitbucket
1. Access your **Repository Settings** in Bitbucket.
2. Under the Workflow section, access **Webhooks**
3. Click **Add Webhook** to configure your webhook
4. Add the public URL to where you have deployed this repo. It is important that you add the *deploy_branch* to the URL which you want to monitor
Sample: `http://www.example.com/git-deploy-tools/webhook.php?deploy_branch=master`


## Server-side configuration

On you server, set up cronjob to run the webhook at your desired interval
example: `*/10	*	*	*	*	/bin/sh /home/example.com/public_html/git-deploy-tools/watchdog.sh`
