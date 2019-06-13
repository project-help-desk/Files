CREATE TABLE IF NOT EXISTS Data (
    `Incident_ID` VARCHAR(15) CHARACTER SET utf8,
    `Client_Name` VARCHAR(58) CHARACTER SET utf8,
    `Client_Number` VARCHAR(13) CHARACTER SET utf8,
    `Date` VARCHAR(19) CHARACTER SET utf8,
    `Time_Registered` VARCHAR(15) CHARACTER SET utf8,
    `Description` VARCHAR(153) CHARACTER SET utf8,
    `Type` VARCHAR(18) CHARACTER SET utf8
);
INSERT INTO Data VALUES
    ('2014-11-01','EFG ','00096','2014-11-01 00:00:00','16:00:00','The owner stops and has to run his annual account immediately. This is not possible because running the annual account is configured and set for January.','Wish'),
    ('2014-11-05','HMC',NULL,'2014-11-10 00:00:00','12:00:00','Cannot record any entries, error data out of size','Technical Problem'),
    ('2014-11-06','ABC-Hek',NULL,'2014-11-11 00:00:00','09:30:00','Our system administrator is ill. We cannot add users at the moment. Can someone of our company get the rights to do so?','Question'),
    ('2014-11-09','Van krootwijk tot Spangen aan de ijssel','09659','2014-11-12 00:00:00','08:00:00','Hoe kan ik personeel opvoeren in de administratie','Question'),
    ('2014-11-12','Childcare  Foundation Emmen','06782','2014-11-12 00:00:00','08:12:00','Server is down','Failure'),
    ('2014-11-13','SC Angelso',NULL,'2014-11-12 00:00:00','08:12:00','Server is down','Failure'),
    ('2014-11-14','0900-discussie platform en forum met 37 spreker in 2 dagen','09540','2014-11-12 00:00:00','08:12:00','Server is down','Failure'),
    ('2014-11-16','0900-discussie platform en forum met 37 spreker in 2 dagen','09540','2014-11-12 00:00:00','08:13:00','Back-up is lost','Functional Problem'),

CREATE TABLE IF NOT EXISTS HistoricalData (
    `Incident_ID` VARCHAR(15) CHARACTER SET utf8,
    `Client_Name` VARCHAR(58) CHARACTER SET utf8,
    `Client_Number` VARCHAR(13) CHARACTER SET utf8,
    `Date` VARCHAR(19) CHARACTER SET utf8,
    `Time_Registered` VARCHAR(15) CHARACTER SET utf8,
    `Description` VARCHAR(153) CHARACTER SET utf8,
    `Type` VARCHAR(18) CHARACTER SET utf8
);
INSERT INTO HistoricalData VALUES
    ('Incident_ID','Client_Name','Client_Number','Date','Time_Registered','Description','Type'),
    ('2014-11-02','Duif ',NULL,'2014-11-05 00:00:00','16:00:00','Request for the back-ups of the annual account','Question'),
    ('2014-11-03','Eekhout schilderwerken','00968','2014-11-06 00:00:00','12:00:00','System doesn''t respond','Technical Problem'),
    ('2014-11-07','Klussenbus jansen en jansen','01534','2014-11-11 00:00:00','08:00:00','DI-error 999 appears on screen','Technical Problem'),
    ('2014-11-08','captain spoor',NULL,'2014-11-11 00:00:00','08:12:00','We get this error message: "Printrequest send to printer". Printing is working though','Functional Problem'),
    ('2014-11-10','SC Angelso',NULL,'2014-11-12 00:00:00','08:00:00','There is a power failure  but the system seems to be working fine. How is that possible?','Question'),
    ('2014-11-11','DS and PD',NULL,'2014-11-12 00:00:00','08:00:00','There is a power failure  but the system seems to be working fine. How is that possible?','Question'),
('2014-11-15','Corp stoeptegels',NULL,'2014-11-12 00:00:00','08:13:00','Log on into the system is not possible','Technical Problem');
