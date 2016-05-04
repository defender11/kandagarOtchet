SELECT  m.main_id main,
                                    a.agreement_id,
                                    a.agreement_name,
                                    srv.service_name,
                                    srv.service_about,
                                    off.office_name,
                                    m.date_start,
                                    m.date_recieved,
                                    mp.month_count_name,
                                    s.stat_month,
                                    s.stat_summ,
                                    c.cash_country,
                                    s.stat_payment,
                                    st.status_name,
                                    st.status_id,
                                    usr.user_login,
                                    usr.user_passwd,
                                    usr.user_access,
                                    usra.user_access_name

                                FROM statistic s

                                JOIN main m
                                ON s.main_id = m.main_id

                                JOIN month_period mp
                                ON  m.month_period_id = mp.month_period_id

                                JOIN office off
                                ON off.office_id = m.office_id

                                JOIN cash c
                                ON c.cash_id = m.cash_id

                                JOIN service srv
                                ON srv.service_id = m.service_id

                                JOIN status st
                                ON st.status_id = s.status_id

                                JOIN agreement a
                                ON a.agreement_id = m.agreement_id

                                JOIN users usr
                                ON m.user_id = usr.user_id

                                JOIN user_access usra
                                ON usr.user_access = usra.user_access_id

                                WHERE date_recieved LIKE
                                ORDER BY m.main_id ASC