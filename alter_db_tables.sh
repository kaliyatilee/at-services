mariadb -udeveloper -pdeveloppass 'muzanya_atservices' -e "ALTER TABLE IF EXISTS dstv_packages ADD COLUMN IF NOT EXISTS amount_rand DOUBLE DEFAULT 0.00,ADD COLUMN IF NOT EXISTS commission_usd DOUBLE DEFAULT 0.00;"
mariadb -udeveloper -pdeveloppass 'muzanya_atservices' -e "ALTER TABLE dstv_transaction ADD COLUMN IF NOT EXISTS transaction_date DATETIME DEFAULT CURRENT_TIMESTAMP;"
mariadb -udeveloper -pdeveloppass 'muzanya_atservices' -e "ALTER TABLE loan_disbursed ADD COLUMN IF NOT EXISTS transaction_date DATETIME DEFAULT CURRENT_TIMESTAMP;"
mariadb -udeveloper -pdeveloppass 'muzanya_atservices' -e "ALTER TABLE insurance_transaction ADD COLUMN IF NOT EXISTS transaction_date DATETIME DEFAULT CURRENT_TIMESTAMP;"
mariadb -udeveloper -pdeveloppass 'muzanya_atservices' -e "ALTER TABLE company_registration ADD COLUMN IF NOT EXISTS transaction_date DATETIME DEFAULT CURRENT_TIMESTAMP;"
mariadb -udeveloper -pdeveloppass 'muzanya_atservices' -e "ALTER TABLE rtgs ADD COLUMN IF NOT EXISTS transaction_date DATETIME DEFAULT CURRENT_TIMESTAMP;"
mariadb -udeveloper -pdeveloppass 'muzanya_atservices' -e "ALTER TABLE permanent_disc ADD COLUMN IF NOT EXISTS transaction_date DATETIME DEFAULT CURRENT_TIMESTAMP;"
mariadb -udeveloper -pdeveloppass 'muzanya_atservices' -e "ALTER TABLE eggs ADD COLUMN IF NOT EXISTS transaction_date DATETIME DEFAULT CURRENT_TIMESTAMP;"
<<<<<<< HEAD
mariadb -udeveloper -pdeveloppass 'muzanya_atservices' -e "ALTER TABLE ecocash ADD COLUMN IF NOT EXISTS transaction_date DATETIME DEFAULT CURRENT_TIMESTAMP;"
=======
>>>>>>> refs/remotes/origin/main

