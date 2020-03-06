package warranty;

import org.junit.Test;

import warranty.Contract;

import junit.framework.Assert;

public class TestContractAdmin {
	
    @Test
    public void TestContractIsSetupCorrectly()
    {
        Contract contract = new Contract(0, 100.0);
        Assert.assertEquals(100.0, contract.purchasePrice);
        Assert.assertEquals(Contract.Status.PENDING, contract.status);
    }
    
}
