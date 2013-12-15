#!/bin/bash

mysql -u eportfolio -p < eportfolio.sql && mysql -u eportfolio -p < dummy_data.sql
