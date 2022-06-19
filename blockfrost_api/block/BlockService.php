<?php 

namespace Blockfrost\Block;



use Blockfrost\Service;

class BlockService extends Service 
{
    public function __construct($network, $projectId)
    {
        parent::__construct($network, $projectId);
    }
    
    public function getLatestBlock():BlockContent
    {
        $resp = $this->get("/blocks/latest");
        
        return $this->resp_from_json($resp, '\Blockfrost\Block\BlockContent');
    }
    
    public function getLatestBlockTransactions():array //<string>
    {
        $resp = $this->get("/blocks/latest/txs");
        
        return $this->resp_from_json($resp, ['array', 'string']);
    }
    
    public function getBlock($hash_or_number):BlockContent 
    {
        $resp = $this->get("/blocks/{$hash_or_number}");
        
        return $this->resp_from_json($resp, '\Blockfrost\Block\BlockContent');
    }
    
    public function listNextBlocks($hash_or_number):array  //<BlockContent>             
    {
        $resp = $this->get("/blocks/{$hash_or_number}/next");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Block\BlockContent' ]);
    }
    
    public function listPreviousBlocks($hash_or_number):array //<BlockContent>
    {
        $resp = $this->get("/blocks/{$hash_or_number}/previous");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Block\BlockContent'] );
    }
    
    public function getSpecificBlockInSlot($slot):BlockContent 
    {
        $resp = $this->get("/blocks/slot/{$slot}");
        
        return $this->resp_from_json($resp, '\Blockfrost\Block\BlockContent');
    }
    
    public function getSpecificBlockInSlotInEpoch($slot, $epoch):BlockContent 
    {
        $resp = $this->get("/blocks/epoch/{$epoch}/slot/{$slot}");
        
        return $this->resp_from_json($resp, '\Blockfrost\Block\BlockContent');
    }
    
    public function getBlockTransactions($hash_or_number):array 
    {
        $resp = $this->get("/blocks/{$hash_or_number}/txs");
        
        return $this->resp_from_json($resp, ['array', 'string' ]);
    }
    public function getAddressesAffectedInBlock($hash_or_number)//:array
    {
        $resp = $this->get("/blocks/{$hash_or_number}/addresses");
        
        $t = ['array', '\Blockfrost\Block\BlockTransaction'];
        
        return $this->resp_from_json($resp, ['array', ['_kind' => 'object', '_type' => '\Blockfrost\Block\BlockAddress', 'address' => 'string', 'transactions' => $t ] ]);
    }
}


?>