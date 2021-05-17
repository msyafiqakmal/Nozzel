#!/usr/bin/python
import mysql.connector
from numpy import loadtxt
import numpy as np
from xgboost import XGBClassifier, XGBRegressor 
from sklearn.model_selection import train_test_split
from sklearn.metrics import accuracy_score
from sklearn.metrics import mean_squared_error, mean_absolute_error
import time
import datetime
import arrow

mydb = mysql.connector.connect(host="localhost", user="root", passwd="root", database="um_petronas")
#mydb = mysql.connector.connect(host="localhost", user="gtd", passwd="gtd123321", database="test_gtd")

mycursor = mydb.cursor()

######################################################## COLLECT ALL TRANING DATA
query = (
        "SELECT a.station_id, a.pump, a.gas_type, a.completion_date, a.adjusted_transaction_count, a.adjusted_total_volume, "
        " c.HP_Nzzl_Dropped_Off, c.HP_Nzzl_Faulty, c.HP_Nzzl_Leaking, c.HP_Nzzl_No_Auto_Stop, c.HP_Nzzl_Pulled_Off, c.HP_Nzzl_Splash_Guard, c.HP_VisiGauge_Leaking, "
        " b.I1_1012, b.I1_1026, b.I1_105, b.I1_109, b.I1_1123, b.I1_113, b.I1_1141, b.I1_1142, b.I1_1143, b.I1_1183, b.I1_136, b.I1_1469, b.I1_1475, b.I1_1487, b.I1_1516, "
        " b.I1_153, b.I1_1628, b.I1_1653, b.I1_169, b.I1_1702, b.I1_171, b.I1_1737, b.I1_1739, b.I1_1740, b.I1_175, b.I1_176, b.I1_1785, b.I1_1819, b.I1_1820, b.I1_1874, "
        " b.I1_1900, b.I1_1902, b.I1_1937, b.I1_1938, b.I1_1960, b.I1_1961, b.I1_1962, b.I1_1967, b.I1_2058, b.I1_2060, b.I1_2061, b.I1_208, b.I1_2131, b.I1_2132, b.I1_2133, "
        " b.I1_2158, b.I1_2281, b.I1_2329, b.I1_245, b.I1_25, b.I1_250, b.I1_2516, b.I1_2517, b.I1_2518, b.I1_2519, b.I1_2520, b.I1_2521, b.I1_256, b.I1_2566, b.I1_2567, "
        " b.I1_2569, b.I1_2571, b.I1_2591, b.I1_2617, b.I1_2629, b.I1_2631, b.I1_2713, b.I1_2749, b.I1_2758, b.I1_2769, b.I1_279, b.I1_2796, b.I1_2800, b.I1_2871, b.I1_3053, "
        " b.I1_3054, b.I1_364, b.I1_369, b.I1_415, b.I1_425, b.I1_436, b.I1_449, b.I1_456, b.I1_471, b.I1_473, b.I1_475, b.I1_478, b.I1_486, b.I1_491, b.I1_495, b.I1_513, "
        " b.I1_517, b.I1_552, b.I1_556, b.I1_557, b.I1_559, b.I1_569, b.I1_570, b.I1_599, b.I1_60, b.I1_607, b.I1_624, b.I1_627, b.I1_628, b.I1_629, b.I1_645, b.I1_646, "
        " b.I1_647, b.I1_650, b.I1_651, b.I1_656, b.I1_660, b.I1_668, b.I1_670, b.I1_671, b.I1_673, b.I1_675, b.I1_676, b.I1_677, b.I1_678, b.I1_679, b.I1_767, b.I1_82, "
        " b.I1_918, a.lifetime "
        "FROM extracted_data_nozzle as a "
        "LEFT JOIN parts_encode_nozzle as b ON b.id=a.id "
        "LEFT JOIN problem_encode_nozzle as c ON c.id=a.id "
        "WHERE a.lifetime>0 "
        "ORDER BY a.station_id, a.pump "
        )
mycursor.execute(query)
myresult = mycursor.fetchall()

result=[]
for row in myresult:
    arr=[ "%s" % x for x in row ]
    for key, value in enumerate(arr):
        if key==0:
            arr[key]=int(float(value[-4:]))  
        elif  key==3:
            d1=arrow.get(value, 'YYYY-MM-DD') #.shift(days=row[-1]) #.format('YYYY-MM-DD') # +row[-1] #modifing date + lifetime records
            arr[key]=d1.timestamp
        elif  key==4:
            arr[key]=float(value)
        elif  key==5:
            arr[key]=float(value)
        else:            
            arr[key]=int(value)
    result.append(arr)
    
x_db = []
y_db = []

for value in result:    
    x_db.append(value[:-1])
    y_db.append(value[-1])

x1=np.asarray(x_db)
y1=np.asarray(y_db)


######################################################## COLLECT DATA FOR PREDECTION
query2 = (
        "SELECT a.id, a.station_id, a.pump, a.gas_type, a.completion_date, a.adjusted_transaction_count, a.adjusted_total_volume, "
        " c.HP_Nzzl_Dropped_Off, c.HP_Nzzl_Faulty, c.HP_Nzzl_Leaking, c.HP_Nzzl_No_Auto_Stop, c.HP_Nzzl_Pulled_Off, c.HP_Nzzl_Splash_Guard, c.HP_VisiGauge_Leaking, "
        "      b.I1_1012, b.I1_1026, b.I1_105, b.I1_109, b.I1_1123, b.I1_113, b.I1_1141, b.I1_1142, b.I1_1143, b.I1_1183, b.I1_136, b.I1_1469, b.I1_1475, b.I1_1487, b.I1_1516, "
        "      b.I1_153, b.I1_1628, b.I1_1653, b.I1_169, b.I1_1702, b.I1_171, b.I1_1737, b.I1_1739, b.I1_1740, b.I1_175, b.I1_176, b.I1_1785, b.I1_1819, b.I1_1820, b.I1_1874, "
        "      b.I1_1900, b.I1_1902, b.I1_1937, b.I1_1938, b.I1_1960, b.I1_1961, b.I1_1962, b.I1_1967, b.I1_2058, b.I1_2060, b.I1_2061, b.I1_208, b.I1_2131, b.I1_2132, b.I1_2133, "
        "      b.I1_2158, b.I1_2281, b.I1_2329, b.I1_245, b.I1_25, b.I1_250, b.I1_2516, b.I1_2517, b.I1_2518, b.I1_2519, b.I1_2520, b.I1_2521, b.I1_256, b.I1_2566, b.I1_2567, "
        "      b.I1_2569, b.I1_2571, b.I1_2591, b.I1_2617, b.I1_2629, b.I1_2631, b.I1_2713, b.I1_2749, b.I1_2758, b.I1_2769, b.I1_279, b.I1_2796, b.I1_2800, b.I1_2871, b.I1_3053, "
        "      b.I1_3054, b.I1_364, b.I1_369, b.I1_415, b.I1_425, b.I1_436, b.I1_449, b.I1_456, b.I1_471, b.I1_473, b.I1_475, b.I1_478, b.I1_486, b.I1_491, b.I1_495, b.I1_513, "
        "      b.I1_517, b.I1_552, b.I1_556, b.I1_557, b.I1_559, b.I1_569, b.I1_570, b.I1_599, b.I1_60, b.I1_607, b.I1_624, b.I1_627, b.I1_628, b.I1_629, b.I1_645, b.I1_646, "
        "      b.I1_647, b.I1_650, b.I1_651, b.I1_656, b.I1_660, b.I1_668, b.I1_670, b.I1_671, b.I1_673, b.I1_675, b.I1_676, b.I1_677, b.I1_678, b.I1_679, b.I1_767, b.I1_82, "
        "      b.I1_918, a.lifetime "
        "FROM extracted_data_nozzle as a "
        "LEFT JOIN parts_encode_nozzle as b ON b.id=a.id "
        "LEFT JOIN problem_encode_nozzle as c ON c.id=a.id "
        "WHERE a.lifetime>0 "
        "ORDER BY a.station_id, a.pump "
        )
mycursor.execute(query2)
myresult2 = mycursor.fetchall()

result2=[]
ids=[]
for row in myresult2:
    arr2=[ "%s" % x for x in row ]    
    
    for key, value in enumerate(arr2):
        if key==0:
            ids.append(value)
        if key==1:
            arr2[key]=int(float(value[-4:]))  
        elif  key==4:
            #print(datetime(value))
            d1=arrow.get(value, 'YYYY-MM-DD').shift(days=row[-1]) #.format('YYYY-MM-DD') # +row[-1] #modifing date + lifetime records
            arr2[key]=d1.timestamp
        elif  key==5:
            arr2[key]=float(value)
        elif  key==6:
            arr2[key]=float(value)
        else:            
            arr2[key]=int(value)
    result2.append(arr2)
    
x_db_new = []
y_db_new = []

for value in result2:    
    x_db_new.append(value[1:-1])
x1_new=np.asarray(x_db_new)

#################################### TRANING MODEL

def predictData(max_seed, max_test_size):
    
    result=[]
    
    for s in range(1, max_seed):
        t=0.1
        while t <= max_test_size: 
            
            # Prepare training and test data
            X_train, X_test, y_train, y_test = train_test_split(x1, y1, test_size=t, random_state=s)

            # model = XGBRegressor()
            model = XGBRegressor(max_depth=7, min_child_weight=1, learning_rate=0.1, n_estimators=500, silent=True, 
                                 objective='reg:linear', gamma=0, max_delta_step=0, subsample=1, colsample_bytree=1, colsample_bylevel=1,
                                 reg_alpha=0, reg_lambda=0, scale_pos_weight=1, seed=1, missing=None)
            model.fit(X_train, y_train)
            
            # make predictions for test data
            y_pred = model.predict(X_test)
            predictions = [round(value) for value in y_pred]

            d=np.subtract(y_test,predictions)    
            r = [ x*x  for x in d ]    

            #RMSRE
            rmsre=100*np.sqrt(sum(r)/len(r))/sum(y_test) 
            
            
            if rmsre<=1.5:
                
                #DO PREDICTION 
                y2_pred = model.predict(x1_new)
                predictions2 = [round(value1) for value1 in y2_pred]

#                 print ('RMSRE =%s Seed = %s  Test_size=%s' % (rmsre, s,t))
#                 print (predictions)
#                 print(' ')    
#                 print (predictions2)
#                 print ('#######################################')
                
                result.append(predictions2)
                
                
            t += 0.1
    return result
        
data=predictData(7,0.5)
#print(data)
#print ("Completed")
data1=np.asarray(data)
preds=np.around(data1.mean(axis=0))

############################################ INSERT TO DATABASE
mycursor.execute("TRUNCATE TABLE data_nozzle_predicted") # CLean prediction table

record=[]
for index, value in enumerate(ids):
    
    sql = "INSERT INTO data_nozzle_predicted (id, related_id, lifetime_predicted) VALUES (%s, %s, %s)"
    val = (0, int(value), int(preds[index]))
    mycursor.execute(sql, val)
    mydb.commit()

print('<span class="text-muted">Number of predicted nuzzles are</span> <span class="text_black"> %s</span>' % (len(ids)))
