# Openload Package
Connect to the Openload File Sharing API to upload, share and edit any file. Test an API call in your browser and export the code snippet into your app.
* Domain: [openload.co](https://openload.co)
* Credentials: login, key

## How to get credentials:
1. Sign in [openload.co](https://openload.co)
2.  You can find credentials in the User Panel at the "User Settings" Tab

## Openload.getAccountInfo
Everything account related (total used storage, reward)

| Field| Type       | Description
|------|------------|----------
| login| credentials| API-Login
| key  | credentials| API-Key / API-Password

## Openload.preparingDownload
Preparing a Download

| Field | Type       | Description
|-------|------------|----------
| login | credentials| API-Login
| key   | credentials| API-Key / API-Password
| fileId| String     | File-ID

## Openload.getDownloadLink
Get a download link by using download ticket

| Field          | Type  | Description
|----------------|-------|----------
| fileId         | String| File-ID
| ticket         | String| Previously generated download ticket
| captchaResponse| String| Result of the captcha

## Openload.checkFileStatus
Check the status of a file, e.g. if the file exists

| Field | Type       | Description
|-------|------------|----------
| login | credentials| API-Login
| key   | credentials| API-Key / API-Password
| fileId| String     | File-ID

## Openload.uploadFile
File upload

| Field   | Type       | Description
|---------|------------|----------
| login   | credentials| API-Login
| key     | credentials| API-Key / API-Password
| file    | File       | Uploaded file
| folderId| String     | Folder-ID to upload to

## Openload.uploadFileRemotely
Remote Uploading a file

| Field   | Type       | Description
|---------|------------|----------
| login   | credentials| API-Login
| key     | credentials| API-Key / API-Password
| url     | File       | Remote URL
| folderId| String     | Folder-ID to upload to

## Openload.checkRemoteUploadStatus
Check Status of Remote Upload

| Field| Type       | Description
|------|------------|----------
| login| credentials| API-Login
| key  | credentials| API-Key / API-Password
| id   | String     | Remote Upload ID
| limit| String     | Maximum number of results (Default: 5, Maximum: 100)

## Openload.showFoldersContent
Shows the content of your folders

| Field   | Type       | Description
|---------|------------|----------
| login   | credentials| API-Login
| key     | credentials| API-Key / API-Password
| folderId| String     | Folder-ID

## Openload.renameFolder
Set a new name for a folders

| Field   | Type       | Description
|---------|------------|----------
| login   | credentials| API-Login
| key     | credentials| API-Key / API-Password
| folderId| String     | Folder-ID
| name    | String     | new Folder-Name

## Openload.renameFile
Set a new name for a file

| Field | Type       | Description
|-------|------------|----------
| login | credentials| API-Login
| key   | credentials| API-Key / API-Password
| fileId| String     | File-ID
| name  | String     | new File-Name



