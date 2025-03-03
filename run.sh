#!/bin/sh

# NOTE: The production server is started by the pipeline, not by this script
docker compose down
docker compose up -d
