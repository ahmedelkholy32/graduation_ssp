using System;
using System.Collections;
using System.Collections.Generic;
using System.Text;
namespace Secuomfs_ssp
{
    #region Orders
    public class Orders
    {
        #region Member Variables
        protected int _number;
        protected string _user;
        protected string _shop;
        protected string _id;
        protected DateTime _start;
        protected DateTime _end;
        protected bool _duration;
        protected int _price;
        protected string _car_plate;
        protected unknown _fopen;
        protected bool _come;
        protected bool _go_out;
        #endregion
        #region Constructors
        public Orders() { }
        public Orders(string user, string shop, string id, DateTime start, DateTime end, bool duration, int price, string car_plate, unknown fopen, bool come, bool go_out)
        {
            this._user=user;
            this._shop=shop;
            this._id=id;
            this._start=start;
            this._end=end;
            this._duration=duration;
            this._price=price;
            this._car_plate=car_plate;
            this._fopen=fopen;
            this._come=come;
            this._go_out=go_out;
        }
        #endregion
        #region Public Properties
        public virtual int Number
        {
            get {return _number;}
            set {_number=value;}
        }
        public virtual string User
        {
            get {return _user;}
            set {_user=value;}
        }
        public virtual string Shop
        {
            get {return _shop;}
            set {_shop=value;}
        }
        public virtual string Id
        {
            get {return _id;}
            set {_id=value;}
        }
        public virtual DateTime Start
        {
            get {return _start;}
            set {_start=value;}
        }
        public virtual DateTime End
        {
            get {return _end;}
            set {_end=value;}
        }
        public virtual bool Duration
        {
            get {return _duration;}
            set {_duration=value;}
        }
        public virtual int Price
        {
            get {return _price;}
            set {_price=value;}
        }
        public virtual string Car_plate
        {
            get {return _car_plate;}
            set {_car_plate=value;}
        }
        public virtual unknown Fopen
        {
            get {return _fopen;}
            set {_fopen=value;}
        }
        public virtual bool Come
        {
            get {return _come;}
            set {_come=value;}
        }
        public virtual bool Go_out
        {
            get {return _go_out;}
            set {_go_out=value;}
        }
        #endregion
    }
    #endregion
}using System;
using System.Collections;
using System.Collections.Generic;
using System.Text;
namespace Secuomfs_ssp
{
    #region Shops
    public class Shops
    {
        #region Member Variables
        protected int _id;
        protected string _shopname;
        protected string _shopname_ar;
        protected int _seat;
        #endregion
        #region Constructors
        public Shops() { }
        public Shops(int id, string shopname_ar, int seat)
        {
            this._id=id;
            this._shopname_ar=shopname_ar;
            this._seat=seat;
        }
        #endregion
        #region Public Properties
        public virtual int Id
        {
            get {return _id;}
            set {_id=value;}
        }
        public virtual string Shopname
        {
            get {return _shopname;}
            set {_shopname=value;}
        }
        public virtual string Shopname_ar
        {
            get {return _shopname_ar;}
            set {_shopname_ar=value;}
        }
        public virtual int Seat
        {
            get {return _seat;}
            set {_seat=value;}
        }
        #endregion
    }
    #endregion
}using System;
using System.Collections;
using System.Collections.Generic;
using System.Text;
namespace Secuomfs_ssp
{
    #region Users
    public class Users
    {
        #region Member Variables
        protected int _id;
        protected string _email;
        protected string _name;
        protected unknown _gender;
        protected unknown _birthday;
        protected string _phone;
        protected string _password;
        protected int _money;
        protected bool _ai;
        #endregion
        #region Constructors
        public Users() { }
        public Users(int id, string name, unknown gender, unknown birthday, string phone, string password, int money, bool ai)
        {
            this._id=id;
            this._name=name;
            this._gender=gender;
            this._birthday=birthday;
            this._phone=phone;
            this._password=password;
            this._money=money;
            this._ai=ai;
        }
        #endregion
        #region Public Properties
        public virtual int Id
        {
            get {return _id;}
            set {_id=value;}
        }
        public virtual string Email
        {
            get {return _email;}
            set {_email=value;}
        }
        public virtual string Name
        {
            get {return _name;}
            set {_name=value;}
        }
        public virtual unknown Gender
        {
            get {return _gender;}
            set {_gender=value;}
        }
        public virtual unknown Birthday
        {
            get {return _birthday;}
            set {_birthday=value;}
        }
        public virtual string Phone
        {
            get {return _phone;}
            set {_phone=value;}
        }
        public virtual string Password
        {
            get {return _password;}
            set {_password=value;}
        }
        public virtual int Money
        {
            get {return _money;}
            set {_money=value;}
        }
        public virtual bool Ai
        {
            get {return _ai;}
            set {_ai=value;}
        }
        #endregion
    }
    #endregion
}