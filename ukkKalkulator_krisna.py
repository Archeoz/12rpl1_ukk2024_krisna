from tkinter import *
import math

def button_handler(v):
    if v in {'*','/','+','-','%'}:
        op_click(v)
    elif v in {'Sin','Cos','Tan'}:
        sct_click(v)
    elif v == "=":
        hitung()
    elif v == "DEL":
        hapus_satu()
    elif v == "C":
        hapus_all()
    else:
        button_click(v)

def op_click(v):
    c = str(layar.get())
    if c and c[-1] in {'*','/','+','-','%'}:
        c = c[:-1]
    layar.delete(0,END)
    layar.insert(END,c + v)

def sct_click(v):
    c = str(layar.get())
    if c and c[-3] in {'Sin','Cos','Tan'}:
        c = c[:-3]
    layar.delete(0,END)
    layar.insert(END,c + v)

def hitung():
    c = str(layar.get())
    try:
        if "%" in c:
            nilai = c.replace('%','/100')
            hasil = eval(nilai)
        elif "Sin" in c:
            nilai = c.replace('Sin','')
            nilai = float(nilai)
            hasil = math.sin(math.radians(nilai))
        elif "Cos" in c:
            nilai = c.replace('Cos','')
            nilai = float(nilai)
            hasil = math.cos(math.radians(nilai))
        elif "Tan" in c:
            nilai = c.replace('Tan','')
            nilai = float(nilai)
            hasil = math.tan(math.radians(nilai))
        else:
            hasil = eval(c)
        layar.delete(0,END)
        layar.insert(END,hasil)
    except:
        layar.delete(0,END)
        layar.insert(END,"Kalkulasi Error")

def hapus_satu():
    c = str(layar.get())
    c = c[:-1]
    layar.delete(0,END)
    layar.insert(END,c)

def hapus_all():
    layar.delete(0,END)

def button_click(v):
    layar.insert(END,v)



app = Tk()
app.title('Simple Calc')
app.resizable(False,False)
app.configure(bg="lightblue")

layar = Entry(app,width=20,borderwidth=5,font=('Arial',25))
layar.grid(padx=8,pady=8,row=0,column=0,columnspan=5)

tombol =[
    'C','DEL','*','/','%',
    '7','8','9','-','Sin',
    '4','5','6','+','Cos',
    '1','2','3','=','Tan',
    '.','0','(',')',
]
row_v = 1
col_v = 0

for tombol in tombol :
    Button(app,text=tombol,command=lambda v=tombol:button_handler(v),width=5,height=3,font=('Arial',12,'bold')).grid(padx=5,pady=5,row=row_v,column=col_v)
    col_v += 1
    if col_v == 5:
        row_v += 1
        col_v = 0

app.mainloop()