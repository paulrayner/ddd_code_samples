package warranty;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;

public class Claim {

	public Claim(int id, double amount, Date date) {
		super();
		this.id = id;
		this.amount = amount;
		this.date = date;
	}
	public int id;
	public double amount;
	public Date date = new Date();
	public List<RepairPO> repairPO = new ArrayList<RepairPO>();
}
