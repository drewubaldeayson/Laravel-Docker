#!/bin/sh

branch="develop"
currentDate=`date`
toplevel=`git rev-parse --show-toplevel`
DRONE_REPO_NAME=`basename $toplevel`
DRONE_COMMIT_SHA=`git log --format="%H" -n 1`
DRONE_COMMIT_LINK="https://codepot.qoneqtor.com/${DRONE_REPO_NAME}/commit/${DRONE_COMMIT_SHA}"
DRONE_COMMIT_AUTHOR=`git log -1 --pretty=format:'%an'`
DRONE_COMMIT_MESSAGE=`git log -1 --pretty=%B`
message="📣 Upcoming Server Updates!

🔥 Hot Patching ➡️ DEV Backend

Date: ${currentDate}
🚀 Powered by LBTEK DevOps"

docker run --rm -e \
PLUGIN_TOKEN=$TG_TOKEN \
-e PLUGIN_TO=$TG_USER \
-e PLUGIN_MESSAGE="$message" \
appleboy/drone-telegram