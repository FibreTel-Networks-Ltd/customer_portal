Introduction

We use Ansible to provision the server and perform the initial deployment. For subsequent deployments, we use [Deployer](deployer.org). A cron job checks for new releases every five minutes using deploy:check_remote and proceeds only if changes are found.

Requirements
1.	Machine with server access
2.	Ansible installed locally
3.	Secrets needed for the .env file

Inventory Configuration (inventory.ini)

```
[staging]
<ip> ansible_user=<user>

[production]
<ip> ansible_user=<user>
```

Defining the Database Secret

```shell
export DB_PASSWORD="<db_password>"
```

Running the Playbook

```shell
ansible-playbook -i inventory.ini server.yaml --ask-become-pass
```
